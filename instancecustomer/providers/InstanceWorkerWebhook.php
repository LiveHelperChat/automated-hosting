<?php

namespace LiveHelperChatExtension\instancecustomer\providers;

class InstanceWorkerWebhook {

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
            include 'modules/lhcron/webhook.php';
        } catch (\Exception $e) {
            \LiveHelperChatExtension\instancecustomer\providers\InstanceWorker::logInstanceError($e);
        }
    }

}