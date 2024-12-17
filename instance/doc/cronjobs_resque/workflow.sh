#!/bin/bash
fileCron='/tmp/running-workflow'

# Run every minute

for i in {1..12}
do
    if [ ! -f $fileCron ];
    then
      touch $fileCron;
      cd /code && /usr/local/bin/php cron.php -s site_admin -e instance -c cron/resque_workflow >> cache/workflow.log
      echo "$(tail -1000 cache/workflow.log)" > cache/workflow.log
      rm -f $fileCron;
    else
      if [ `stat --format=%Y $fileCron` -le $(( `date +%s` - 30 )) ]; then
        rm -f $fileCron;
      fi
      echo "Already running"
    fi
    sleep 5
done
