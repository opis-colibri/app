Opis Colibri Framework
======================
[![Latest Stable Version](https://poser.pugx.org/opis-colibri/app/version.svg)](https://packagist.org/packages/opis-colibri/app)
[![Latest Unstable Version](https://poser.pugx.org/opis-colibri/app/v/unstable.svg)](//packagist.org/packages/opis-colibri/app)
[![License](https://poser.pugx.org/opis-colibri/app/license.svg)](https://packagist.org/packages/opis-colibri/app)


## Installation

Before trying to install Opis Colibri make sure you have Docker installed.

```bash
docker pull docker.pkg.github.com/opis-colibri/app/cli-alpine:latest
git clone https://github.com/opis-colibri/app.git myapp
cd myapp && composer docker install
```

Once the project is installed, you can start the built-in PHP server. The server will start on port `8080`.

```bash
composer docker-serve
```

### Local server

```bash
 php -S localhost:8080 -c php.ini -t public router.php
```

### Apache configuration

```apache
<VirtualHost *:80>

    ServerName  website.dev
    DocumentRoot /var/www/website.dev/public
    Alias /assets /var/www/website.dev/assets

    <Directory /var/www/website.dev/public>

        AllowOverride All
        Order allow,deny
        allow from all

    </Directory>

</VirtualHost>
```

### Nginx configuration

```nginx
server {
    listen 80;
    server_name website.dev;
    root "/var/www/website.dev/public";

    index index.html index.htm index.php;

    charset utf-8;

    location /assets/ {
        alias "/var/www/website.dev/assets/";
        try_files $uri $uri/ /index.php?$query_string;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log off;
    error_log  /var/log/nginx/website.dev-error.log error;

    sendfile off;

    client_max_body_size 100m;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }
}
```

### Documentation

No documentation available yet.
