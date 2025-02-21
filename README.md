Automated hosting plugin
=================

This includes only livehelperchat.com automation plugin and API which will have to be called from your frontend site if you decide to do it. It also allows to create instances directly from manager interface. This plugin does not include frontend site, you will have to make integration with API by yourself. This plugin is dedicated for web agencies and some experience with programming is required. If you will need commercial support during installation and configuration you can order commercial support, or ask help in discord.

## How does it works?
You will have manager interface where you can create instances for your clients. Each client get's it's own database. 

## How to install

### Manager installation

* Install fresh version from https://github.com/LiveHelperChat/livehelperchat
* Add these settings in settings/settings.ini.php file under site section

```php
'support_mail' => 'info@livehelperchat.com',
'sender_mail' => 'info@livehelperchat.com',	  
'seller_url' => 'http://livehelperchat.com',// Change to main site url
'seller_domain' => 'livehelperchat.com',// Change to main site url
'seller_mail' => 'info@livehelperchat.com', // Change mail
'manager_subdomain' => 'manage',// Change to subdomain where manager itself is located
'seller_title' => 'Live Helper Chat',	    // Change to your company title
'seller_secret_hash' => 'any_random_string',  // Change to any random string
'expire_disabled' => false,  // Should instances be checked against expire date
'instance_handler' => 'erLhcoreClassInstanceDBMysql', // erLhcoreClassInstanceDBMysql - mysql, erLhcoreClassInstanceDBDirectAdmin - direct admin
'access_log_path' => '/var/log/nginx/access_chat_manager_client.log',  //or '/var/log/apache2/access_chat_manager_client.log' use your site's log name
'http_mode' => 'https://', // Set http:// or https://
'terminate_period' => 14,
'expire_disabled' => false,
'hide_billing' => false,
'phoneattributes' => array(),
'seller_paypal_mail' => 'remdex@gmail.com',
'seller_paypal_options' => array(
 '250K'   => array('p' => 31,'r' => 25000000),
 '1.5M'   => array('p' => 31,'r' => 150000000),
 '3M' 	  => array('p' => 31,'r' => 300000000),
 '1Month' => array('p' => 31,'r' => 0),
),
'seller_attributes' => "Remigijus Kiminas\nDarželio 31\nŠiauliai\nLithuania\nremdex@gmail.com\nTax ID: 591583",
'seller_paypal_enabled' => true,
'seller_smtp' => array(
   'enabled' => true,
   'host' => 'smtp.gmail.com',
   'port' => 587,
   'smtp_secure' => 'tls',
   'smtp_auth' => true,
   'username' => 'admin@example.com',
   'password' => 'password', // You may need to create an application password if you are suing google smtp
   'hostname' => 'example.com',
),
```

* In `db` section add `database_user_prefix` parameter. It will be used to create new databases for each client. Example: "lhc_manage_client_23". 

E.g 
```php
'db' => 
    array (
      'host' => '127.0.0.1',
      'user' => 'dbuser',
      'password' => 'password',
      'database' => 'lhc_manager',
      'database_user_prefix' => 'lhc_manage_client_',
      'port' => 3306,
      'use_slaves' => false,
      'db_slaves' => 
      array (
        0 => 
        array (
          'host' => '',
          'user' => '',
          'port' => 3306,
          'password' => '',
          'database' => '',
        ),
      ),
    ),
```

* Clone https://github.com/LiveHelperChat/automated-hosting to extensions folder or any other folder. 
* Link `instance` to `extension/instance` folder.

So `ls -l lhc_web/extension` should look like this

```
instance -> /home/www/admin/automated-hosting/instance
instanceoverride -> /home/www/admin/automated-hosting/instanceoverride
lhcphpresque -> /home/www/git/lhc-php-resque/lhcphpresque
```

* Execute in fresh installed database query from `extension/instance/doc/install.sql`.  You can use the command line or a tool like phpmyadmin if installed.

* Activate extension in main `lhc_web/settings.ini.php` file

```php 
'extensions' => array ('instanceoverride','instance','lhcphpresque')
```

* Edit `lhc_web/var/autolaods/lhextension_autoload.php`

```php
return array(
        'erLhcoreClassModelInstance' 		=> 'extension/instance/classes/erlhcoreclassmodelinstance.php',
        'erLhcoreClassInstance' 		    => 'extension/instance/classes/erlhcoreclassinstance.php',
        'erLhcoreClassInstanceDBMysql' 		=> 'extension/instance/classes/dbhandlers/mysql.php',
        'erLhcoreClassInstanceDBDirectAdmin'=> 'extension/instance/classes/dbhandlers/directadmin.php',
        'HTTPSocket' 				        => 'extension/instance/classes/dbhandlers/httpsocket.php',
        'erLhcoreClassModelInstanceInvoice'	=> 'extension/instance/classes/erlhcoreclassmodelinstanceinvoice.php',
);
```

Now you will see instance from top menu. There you can create manually new instances.

* Setup cronjonb to run every minute. I have also prepared an sh version of cronjob which avoids running script more than once at the same time.

Plain php version. `cron.php` is located in the installation folder.

```shell
* * * * * cd /home/www/domains/livehelperchat_manager_com && php cron.php -s site_admin -e instance -c cron/maintain
```

You main need to adjust paths here and in cron_lhc.sh script itself. sh script is located at `extension/instance/doc/cron_lhc.sh`

```cron
* * * * * cd /home/www/cronjobs && ./cron_lhc.sh > cron_lhc.log /dev/null 2>&1
```

`cron_lhc.sh` script content for quick reference. You will need to change paths.

```shell
#!/bin/bash

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
```

* This plugins limits functionality purely by time and purchases request number. Setup this cronjob every 30 minutes or so.
```cron
* * * * * cd /home/www/domains/livehelperchat_manager_com && php cron.php -s site_admin -e instance -c cron/update_counter
```

If using Nginx change the log format for update view counter to work correctly.

```nginx
log_format  main  '$remote_addr $http_host - [$time_local] "$request" '
'$status $body_bytes_sent "$http_referer" '
'"$http_user_agent" "$http_x_forwarded_for"';
```

Make sure you have provided correct path `access_log_path` to access log in settings.ini.php in step 2

* If you are not using `php-resque` for background jobs you have to execute this cronjob every 10 minutes. If you have little number of clients, you can execute it every minute. You don't need it if you will install php-resque as background jobs handler.
* This cronjob is reposible for auto assignment and main jobs for the instance.
    
```cron
* * * * * cd /home/www/domains/livehelperchat_manager_com && php cron.php -s site_admin -e instance -c cron/workflow
```

## Client installation

* Now make copy of installed lhc to another directory where all request for <lhc_name>.example.com will go.

Delete from copied folder `extension/instance` and `extension/instanceoverride` folders.

All subdomains should be pointed to new copied directory. Update Apache virtual hosts or nginx as needed. See nginx configuration below.

* Edit  `var/autoloads/lhextension_autoload.php` in copied directory and make it look like

```php
return array(
'erLhcoreClassModelInstance' 		    => 'extension/instancecustomer/classes/erlhcoreclassmodelinstance.php',
'erLhcoreClassInstance' 		        => 'extension/instancecustomer/classes/erlhcoreclassinstance.php',
'erLhcoreClassLazyDatabaseConfiguration'=> 'extension/instancecustomer/classes/lhdb.php',
'erLhcoreClassModelInstanceInvoice' 	=> 'extension/instancecustomer/classes/erlhcoreclassmodelinstanceinvoice.php',
'erLhcoreClassModelInstanceAlias' 	    => 'extension/instancecustomer/classes/erlhcoreclassmodelinstancealias.php'
);
```

* Symbolic links in extensions folder should look like this

```shell
instancecustomer -> /home/www/admin/automated-hosting/instancecustomer
lhcphpresque -> /home/www/git/lhc-php-resque/lhcphpresque
instancecustomeroverride -> /home/www/admin/automated-hosting/instancecustomeroverride
nodejshelper -> /home/www/git/NodeJS-Helper/nodejshelper
```

Install cronjob which will remove expired instances

```cron
* * * * * cd /home/www/client/lhc_web && php cron.php -s site_admin -e instancecustomer -c cron/remove_expired
```

* Activate extension in main `lhc_web/settings/settings.ini.php` file . It should look like

```php 
    'extensions' =>
     array (
        'instancecustomeroverride',
        'instancecustomer',
        'lhcphpresque',
        'nodejshelper',
    ),
```

* Change in main `lhc_web/settings/settings.ini.php` file `'default_site_access' => 'eng'` to `'default_site_access' => 'noneexist'`

* Apppend in `site_access_options` one more array

```php
'noneexist' =>
    array (
        'locale' => 'en_EN',
        'content_language' => 'en',
        'dir_language' => 'ltr',
        'default_url' =>
        array (
            'module' => 'chat',
            'view' => 'startchat',
        ),
        'theme' =>
        array (
            0 => 'customtheme',
            1 => 'defaulttheme',
        ),
    ),
```
That's it.

* Now if you are using paypal edit your paypal button template. I recommend just create extension and override it also.

```
instancecustomer/design/instancecustomertheme/tpl/lhinstance/billing_paypal.tpl.php
```

You should also set in your paypal button that it should send data in UTF8
And notify url provide
E.g
http://manager.livehelperchat.com/instance/paypalipn


* Don't forget to clear cache

* All changes you want to apply to automated hosting extension should go to extension folder named `<bin name><override>`

```
    instancecustomeroverride
    instanceoverride
```

## PHP-Resque installation

* Install php-resque as described [here](https://github.com/LiveHelperChat/lhc-php-resque). Extensions has to be installed for manager and client.

```
* * * * * www-data cd /var/app/current/scripts && ./workflow.sh >> /dev/null 2>&1
* * * * * www-data cd /var/app/current/scripts && ./webhook.sh >> /dev/null 2>&1
17 */8 * * * cd /home/www/manager/lhc_web && php cron.php -s site_admin -e instance -c cron/resque_archive >> /dev/null 2>&1
*/4 * * * * cd /home/www/manager/lhc_web && php cron.php -s site_admin -e instance -c cron/resque_delete >> /dev/null 2>&1
```

`workflow.sh` and `webhook.sh` can be found [here](https://github.com/LiveHelperChat/automated-hosting/tree/master/instance/doc/cronjobs_resque)

PHP-Resque will be running itself under client directory.

```cron
* * * * * cd /home/www/cronjobs && ./resque.sh > /dev/null 2>&1
40 7 * * * /bin/touch /home/www/cronjobs/runresque.lock > /dev/null 2>&1
```

`resque.sh` file content

```shell
#!/bin/bash

## exit immediately if uptime is lower than 120 seconds:
uptime_secs=$(cat /proc/uptime | /bin/cut -d"." -f1)
if (( ${uptime_secs} < 120 )); then
    echo "uptime lower than 120 seconds. Exit."
    exit 1
fi

fileCron='/home/www/cronjobs/.enable-cron'

if [ -f $fileCron ];
then

numberProcess=$(ps aux | grep "[0-9] resque-1.2: *" | awk '{print $2}' | wc -l)

if (( $numberProcess > 24 ));
then
  echo "To many running process..."
  exit 1
fi

fileLock="/home/www/cronjobs/runresque.lock"

if [ -f $fileLock ];
then
    kill -9 $(ps aux | grep "php resque.php" | awk '{print $2}')
    kill -9 $(ps aux | grep "[0-9] resque-1.2: *" | awk '{print $2}')
    cd /home/www/cronjobs/ && ./phpresque.sh &
    rm -f $fileLock;
else
    PIDS=`ps aux | grep '[0-9] resque-1.2: *'`
    if [ -z "$PIDS" ]; then
       echo "Starting resque"
       cd /home/www/cronjobs/ && ./phpresque.sh &
    fi
fi

fi
```

`phpresque.sh` file content
```shell
#!/bin/bash
# live site cronjobs

echo "Running live site cronjobs"
cd /home/www/client/lhc_web
REDIS_BACKEND=localhost:6379 INTERVAL=5 REDIS_BACKEND_DB=1 COUNT=24 VERBOSE=0 QUEUE='*' /usr/bin/php resque.php 2>&1
```

In `lhc_web/extension/lhcphpresque/settings/settings.ini.php` change `'automated_hosting' => true,`

## NodeJS installation

Install NodeJS as described [here](https://github.com/LiveHelperChat/NodeJS-Helper) NodeJS has to be installed only on client instance.

Sample settings

```php
return array(
    'connect_db' => 'localhost',
    'connect_db_id' => 0,
    'connect_db_pass' => null,
    'automated_hosting' => true,
    'public_settings' => array(
        'hostname' => (isset($_SERVER['HTTP_HOST']) ? explode(':',$_SERVER['HTTP_HOST'])[0] : null),
        'path' => '/socketcluster/',
        'port' => null, //some custom port
        'secure' => erLhcoreClassSystem::$httpsMode, // true || false
        'track_visitors' => 0 // true || false
    )
);
```

# FAQ
## What for this plugin is usefull?
For any web agency looking for option to rent it to their clients without requirement to install it every time. Save time and focus on sales.

## By what paremeter customers are limited?
Plugin limits clients functionality just by number of request they issue (http requests) and time the request package expires. You can manage all clients in manager interface.

## How do you handle different instances?
Each instance get's it's own database. Also uploaded files structure is different and instance id is appended to file path.

## What are requirements?
VPS with ssh access. It can be dedicated or virtual server with linux os.

## Do you do installation and configuration
Yes I do. 600$ single time fee. SSH logins will have to be provided. Permission to remove meta tag is not included in the price although combining these two I can make some significant discount. I also suggest to take a look at this commercial offer. This offer also includes NodeJS extension installation also Co-Browsing NodeJS installation.

## I have update translations in my language but i still see english?
You have to clear cache from console by executing "php cron.php -s site_admin -c cron/util/clear_cache"

## What is included in plugin?

 * Customer site plugin
 * Instance site plugin
* Cronjobs, includes shell example

## Does this extension has api to automate new customers creation?
Yes it does. There is api to create new instances. API class on github

## Can I provide all parameters usign API for new instance which I see creating instance from back office?
Yes you can.

## Does this plugin support NodeJS extension?
Yes

## I have purchased automated hosting snapshot from you how to upgrade?
Just execute these commands. And everything will be upgraded

```bash
cd /var/www/admin/automated-hosting && git pull origin master
cd /var/www/manager/ && git pull origin master
cd /var/www/client/lhc_web && git pull origin master
cd /var/www/manager/lhc_web && php cron.php -s site_admin -c cron/util/update_database
cd /var/www/manager/lhc_web && php cron.php -s site_admin -e instance -c cron/update_structure
cd /var/www/manager/lhc_web && php cron.php -s site_admin -e instance -c cron/update_instances
cd /var/www/manager/lhc_web && php cron.php -s site_admin -e instance -c cron/extensions_update
cd /var/www/manager/lhc_web && php cron.php -s site_admin -c cron/util/clear_cache
cd /var/www/client/lhc_web && php cron.php -s site_admin -c cron/util/clear_cache
```

 