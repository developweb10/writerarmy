## ACL

### Installation:
* First, add the following lines in `composer.json` file.

```
#!json


  "laravelcollective/html": "5.2.*",
  "pingpong/modules": "~2.0"
```


* Then, run : `composer update`

* Next add the following service provider in `config/app.php`. 

```
#!php

      Collective\Html\HtmlServiceProvider::class,
      'Pingpong\Modules\ModulesServiceProvider',

```
* Next, add the following aliases to aliases array in the same file.

```
#!php

      'HTML'      => Collective\Html\HtmlFacade::class,
      'Module' => 'Pingpong\Modules\Facades\Module',
```

* Next publish the package's configuration file by run :

```
#!bash


    php artisan vendor:publish
```

* **Autoloading** - By default controllers, entities or repositories not loaded automatically. You can autoload all that stuff using psr-4. For example :


```
#!json

      {
        "autoload": {
          "psr-4": {
            "App\\": "app/",
            "Modules\\": "modules/"
          }
        }
      }

```

* Create a folder named `modules` in the root directory of your project and paste this folder within that directory.
* Now, Run: 
```
#!bash

composer dump -o
```


* Then, run:


```
#!bash

        php artisan module:migrate Acl
        php artisan module:seed Acl

```
    
* URL to check the Acl implementations:

1.     [localhost:8000/acl](http://localhost:8000/acl)
2.     [localhost:8000/acl/roles](http://localhost:8000/acl/roles) 
3.     [localhost:8000/acl/permissions](http://localhost:8000/acl/permissions)
