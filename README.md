box4b\SystemBundle
=============

Bind Linux System Events (cron, init) with Symfony Event.

Configuration
-------------

###AppKernel

add this to your registerBundles() on AppKernel :

```
new box4b\SystemBundle\SystemBundle()
```


###For Cron

Create a `/etc/cron.d/box4bsystem` file containing :

```
* * * * *	[YOUR_USER]	/usr/bin/php [PATH_TO_SYMFONY_PROJECT]/app/console box4b:cron --env=prod > /dev/null 2> /dev/null
```

###For Init / Systemd

Create a file calling /usr/bin/php [PATH_TO_SYMFONY_PROJECT]/app/console box4b:init [start|stop]

Usage
-------------

Use Symfony Event Listener System to listen for events :

###Init

+ box4b\SystemBundle\Event\InitEvent::EVENT_START
+ box4b\SystemBundle\Event\InitEvent::EVENT_STOP

###Cron

+ box4b\SystemBundle\Event\CronEvent::EVERY_MINUTE
+ box4b\SystemBundle\Event\CronEvent::EVERY_FIVE_MINUTES
+ box4b\SystemBundle\Event\CronEvent::EVERY_HOUR
+ box4b\SystemBundle\Event\CronEvent::EVERY_DAY
+ box4b\SystemBundle\Event\CronEvent::EVERY_WEEK

Enjoy :)
