Opis Colibri App
============
[![Latest Stable Version](https://poser.pugx.org/opis-colibri/app/version.svg)](https://packagist.org/packages/opis-colibri/app)
[![Latest Unstable Version](https://poser.pugx.org/opis-colibri/app/v/unstable.svg)](//packagist.org/packages/opis-colibri/app)
[![License](https://poser.pugx.org/opis-colibri/app/license.svg)](https://packagist.org/packages/opis-colibri/app)

Default application for the Opis Colibri framework
-------------

### Installation

```bash

# Install composer

curl -sS https://getcomposer.org/installer | php

# Make it globally available (optional)

sudo mv composer.phar /usr/local/bin/composer

# Install Opis Colibri

cd /var/www

composer create-project opis-colibri/app website.dev 1.0.x-dev

```

### Built-in PHP web server

```bash
# Go to site folder

cd website.dev

# Start server

php -S localhost:8080 -t public router.php
```

### Apache configuration

```apache
<VirtualHost *:80>

    ServerName  website.dev
    DocumentRoot /var/www/website.dev/public

    <Directory /var/www/<website.dev/public>

        AllowOverride All
        Order allow,deny
        allow from all

    </Directory>

</VirtualHost>
```

### Documentation

No documentation available yet.