#!/bin/bash

fileCronHook='/tmp/running-webhook'

# Run every minute

for i in {1..3}
do
    if [ ! -f $fileCronHook ];
    then
      touch $fileCronHook;
      cd /code && php cron.php -s site_admin -e instance -c cron/resque_webhook >> cache/webhook.log
      echo "$(tail -1000 cache/webhook.log)" > cache/webhook.log
      rm -f $fileCronHook;
    else
      if [ `stat --format=%Y $fileCronHook` -le $(( `date +%s` - 30 )) ]; then
        rm -f $fileCronHook;
      fi
      echo "Already running"
    fi
    sleep 20
done
