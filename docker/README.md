# yii2dock

## Intro
There is a **Basic** Yii2-tuned development environment.  
Typical directory structure looks like::
<pre>  
/ -  (project directory)
  | - application (your code should be here, document_root by default)
  | - docker (that environment)
</pre>
Anywhere, you able to make your oun project structure
All configs in .gitignore. Just rename the *.example ones and modify it as you wish.  
Original base images only! Easy to fork and modify! :)  

### Usage
Copy *.example to regular files and do your best config!

## Workspace
Base Image: centos:7  
Container is ready to install yii2
- php-cli + extensions, git, composer (global) + fxp

## Nginx
Base Image: nginx:alpine
- regenerate dhparam.pem
- generate self-signed certificate of place another one to /etc/nginx/ssl directory
- if needed rename nginx.conf.example and tune it: https, workers, gzip, etc
- fix vhost config: server_name, https section

### SSL howto
Coming...

## Percona
Base Image: percona:5.7
- if needed rename my.cnf.example and tune it

## PHP-FPM
Base Image: php:fpm-alpine

### Global TODO
- .env-file
- document_root arg
- install node npm | yarn
- webpack | gulp
- production | development mode: will affect vhost config and some yii2 options
- auto generate certificate: self-signed or LetsEncrypt with vhost-config tuning
- support yii2-app-advanced template