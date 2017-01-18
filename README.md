Symfony-Catalog
===============

Welcome to the Symfony-Catalog - a simple example catalog 
that you can use as the skeleton for your new products catalog.

Installation
============
Symfony-Catalog work with PHP 5.6 or later and MySQL 5.4 or later (please check requirements)

### From repository

Get Symfony-Catalog source files from GitHub repository:
```
git clone https://github.com/Konstyantin/Symfony-Catalog.git %path%
```

Download `composer.phar` to the project folder:
```
cd %path%
curl -s https://getcomposer.org/installer | php
```

Install composer dependencies with the following command:
```
php composer.phar install
```

Running test suite
==================
Tests are located in tests directory. By default test suites:
  
  * unit
  
  * functional
  
Tests can be executed by running

~~~~~~~~
./vendor/bin/phpunit
~~~~~~~~

Loading Fixtures
================
You can load fixtures via the command line by using the doctrine:fixtures:load command:
  
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
php bin/console doctrine:fixtures:load 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration
    
  * [**FOSUserBundle**][14] - Provides a flexible framework for
    user management that aims to handle common tasks such as user registration
    and password retrieval 
    
  * [**DoctrineMigrationsBundle**][15] - Allow safely and
    quickly manage database migrations.
    
  * [**Sonata Admin Bundle**][16] - The missing Symfony
   Admin Generator
   
  * [**KnpPaginatorBundle**][17] - Paginator to paginate everything 
  
  * [**JMSI18nRoutingBundle**][18] - i18n Routing Bundle for the Symfony Framework
  
  * [**VichUploaderBundle**][19] - is a Symfony bundle that attempts to 
    ease file uploads that are attached to ORM entities

[1]:  https://symfony.com/doc/3.2/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.2/doctrine.html
[8]:  https://symfony.com/doc/3.2/templating.html
[9]:  https://symfony.com/doc/3.2/security.html
[10]: https://symfony.com/doc/3.2/email.html
[11]: https://symfony.com/doc/3.2/logging.html
[12]: https://symfony.com/doc/3.2/assetic/asset_management.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: http://symfony.com/doc/current/bundles/FOSUserBundle/index.html
[15]: http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
[16]: https://symfony.com/doc/current/bundles/SonataAdminBundle/index.html
[17]: https://github.com/KnpLabs/KnpPaginatorBundle
[18]: https://github.com/schmittjoh/JMSI18nRoutingBundle
[19]: https://github.com/dustin10/VichUploaderBundle