#!/bin/sh

# live site cronjobs
echo "Running live site cronjobs"
cd /home/www/domains/livehelperchat_manager_com

fileLock='/home/www/cronjobs/cron_workflow.lock'

if [ -f $fileLock ];
then
    echo "Lock file exists, skipping execution";
else
    touch $fileLock;
    /usr/bin/php cron.php -s site_admin -e instance -c cron/workflow > cron_workflow.log
    rm -f $fileLock;
fi