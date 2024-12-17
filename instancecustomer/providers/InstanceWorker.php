<?php

namespace LiveHelperChatExtension\instancecustomer\providers;

class InstanceWorker {

    public function perform()
    {
        $db = \ezcDbInstance::get();
        $db->reconnect(); // Because it timeouts automatically, this calls to reconnect to database, this is implemented in 2.52v

        $cfg = \erConfigClassLhConfig::getInstance();
        $db->query('USE ' . $cfg->getSetting('db', 'database'));

        $instance = \erLhcoreClassModelInstance::fetch($this->args['inst_id']);
        \erLhcoreClassInstance::$instanceChat = $instance;

        $db->query('USE ' . $cfg->getSetting('db', 'database_user_prefix') . $this->args['inst_id']);

        try {
            include 'modules/lhcron/workflow.php';
        } catch (\Exception $e) {
           self::logInstanceError($e);
        }

        try {
            include 'modules/lhcron/transfer_workflow.php';
        } catch (\Exception $e) {
            self::logInstanceError($e);
        }

        /**
         * include 'modules/lhcron/syncmail.php';
         */
        $mailbox = \erLhcoreClassModelMailconvMailbox::getList(['filter' => ['active' => 1]]);
        foreach ($mailbox as $mail) {
            \erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_mailconv', 'erLhcoreClassMailConvWorker', array('inst_id' => $this->args['inst_id'], 'mailbox_id' => $mail->id));
        }
        \erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_imap_copy', '\LiveHelperChat\mailConv\workers\SentCopyWorker', array('inst_id' => $this->args['inst_id']));

        /**
         * include 'modules/lhcron/update_views.php';
         */
        $timeoutValue = (int)\erLhcoreClassModelChatConfig::fetchCache('sync_sound_settings')->data['online_timeout'];
        foreach (\erLhAbstractModelSavedSearch::getList([
            'limit' => false,
            'customfilter' => ['(`user_id` IN (SELECT DISTINCT `user_id` FROM `lh_userdep` WHERE `last_activity` > '.  (int)(time() - $timeoutValue) .') )'],
            'filter' => ['passive' => 0],
            'filterlt' => ['updated_at' => time() - 2 * 60],  // Only views which was updated more than 2 minutes ago
            'filtergt' => ['requested_at' => time() - 5 * 60] // Only views where operator requested update during last 5 minutes
        ]) as $search) {
            \erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_views_update', 'erLhcoreClassViewResque', array('inst_id' => $this->args['inst_id'], 'view_id' => $search->id));
        }

        /**
         * include 'modules/lhcron/mailing.php';
         */
        $campaignValid = \erLhcoreClassModelMailconvMailingCampaign::getList(['filternot' => ['status' => \erLhcoreClassModelMailconvMailingCampaign::STATUS_FINISHED], 'filterlt' => ['starts_at' => time()], 'filter' => ['enabled' => 1]]);
        foreach ($campaignValid as $campaign) {
            if (\erLhcoreClassRedis::instance()->llen('resque:queue:lhc_mailing') <= 4) {
                \erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_mailing', 'erLhcoreClassMailConvMailingWorker', array('inst_id' => $this->args['inst_id'], 'campaign_id' => $campaign->id));
            }
        }

        /**
         * php cron.php -s site_admin -c cron/report
         *
         * Run every minit.
         *
         * */
        \LiveHelperChat\Validators\ReportValidator::sendReports();

        /**
         * php cron.php -s site_admin -c cron/mail/auto_close
         * */
        try {
            include 'modules/lhcron/mail/auto_close.php';
        } catch (\Exception $e) {
            self::logInstanceError($e);
        }

        \erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.instance.workflow',array('instance' => \erLhcoreClassInstance::$instanceChat));
    }

    public static function logInstanceError($e)
    {
        \erLhcoreClassLog::write(
            json_encode([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], \JSON_PRETTY_PRINT),
            \ezcLog::SUCCESS_AUDIT,
            array(
                'source' => 'Instance',
                'category' => 'worker',
                'line' => __LINE__,
                'file' => __FILE__,
                'object_id' => 0
            )
        );
    }

}