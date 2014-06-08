#!/bin/sh

# live site cronjobs
echo "Running live site cronjobs"
cd /home/www/domains/livehelperchat_manager_com

fileLock='/home/www/cronjobs/cron_lhc.lock'

if [ -f $fileLock ];
then
    echo "Lock file exists, skipping execution";
else
    touch $fileLock;
    /usr/bin/php cron.php -s site_admin -e instance -c cron/maintain > cron_lhc.log
    rm -rf var/storage/2013y
    rm -f $fileLock;
fi