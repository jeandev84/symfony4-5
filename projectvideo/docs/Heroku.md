### Heroku
- https://devcenter.heroku.com/articles/heroku-cli
```php
.env 
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

./composer.json 
"require": {
        "php": ">=7.1.3",
        "ext-ctype": "*",
        "ext-curl": "*",
        "ext-iconv": "*",
        "ext-intl": "*",
        "ext-sqlite3": "*",
        "ext-pdo_sqlite": "*"
}


$ bin/console make:migration

Will be generated next files
./migrations
./var/data.db 


$ bin/console doctrine:migrations:migrate
$ bin/console doctrine:fixtures:load 

.htaccess

... 
<IfModule mod_rewrite.c>
    RewriteEngine On

    # For HTTPS PROTOCOL
    RewriteCond %{HTTP:X-Forwarded-Proto} !https
    RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
... 

.gitignore 
/var/cache/
/var/log/
/var/sessions
/var/spool/


Remove git cache and push code
$ git rm -r --cached .  


Install HEROKU
$ curl https://cli-assets.heroku.com/install-ubuntu.sh | sh
$ heroku --version 
heroku/7.67.1 linux-x64 node-v14.19.0

$ heroku login 
heroku: Press any key to open up the browser to login or q to exit: 
Logging in ... done 
Logged in as yourvalidemail@ymail.com

$ heroku create
Creating app... done, 
https://glacial-mountain-67821.herokuapp.com/ | https://git.heroku.com/glacial-mountain-67821.git

$ heroku config:set APP_DEV=heroku
$ heroku config:set APP_SECRET=0
$ heroku config:set DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db 
$ echo 'web: $(composer config bin-dir)/heroku-php-apache2 public/' > Procfile

$ git add -A && git commit -m "c"
$ git push heroku c_126:master
$ git branch
c_126
```
