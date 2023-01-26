### UploadFiles
- https;//vimeo.com/manage/videos

```php 
Composer JSON
"scripts": {
    "auto-scripts": {
    "cache:clear": "symfony-cmd",
    "assets:install %PUBLIC_DIR%": "symfony-cmd"
    //"security-checker security:check": "script"
    },
    "post-install-cmd": [
    "@auto-scripts"
    ],
    "post-update-cmd": [
    "@auto-scripts"
    ]
},
```

1. Create a property for uploading file
```php 
$ bin/console make:entity Video

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > uploaded_videos

 Field type (enter ? to see all types) [string]:
 > ?

Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

Relationships / Associations
  * relation (a wizard 🧙 will help you build the relation)
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

Other Types
  * ascii_string
  * decimal
  * guid


 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration


```

2. Create a VideoType 
```php 
$ bin/console make:form VideoType

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Video

 created: src/Form/VideoType.php

           
  Success! 
           

 Next: Add fields to your form and start using it.
 Find the documentation at https://symfony.com/doc/current/forms.html

```