#!/bin/bash

set -eux -o pipefail

environment="centos_guest,dev"

if [ "$#" -ge 1 ]; then
    environment=$1
fi

echo "environment is ${environment}";

# For all environments other than centos_guest do a `composer install`  
if [[ "${environment}" != *"centos_guest"* ]]
then
    github_access_token=`php bin/info.php "github.access_token"`
    [ -z "${github_access_token}" ] && echo "Need to set github_access_token" && exit 1;
    composer config -g github-oauth.github.com ${github_access_token}
    #Run Composer install to get all the dependencies.
    php -d allow_url_fopen=1 /usr/sbin/composer install --no-interaction --prefer-dist
fi

# Create data directories
mkdir -p ./var/cache/less
mkdir -p ./autogen

#Generate the config files for nginx, etc.
vendor/bin/configurate -p data/config.php data/config_template/nginx.conf.php autogen/nginx.conf $environment
vendor/bin/configurate -p data/config.php data/config_template/php-fpm.conf.php autogen/php-fpm.conf $environment
vendor/bin/configurate -p data/config.php data/config_template/php.ini.php autogen/php.ini $environment
vendor/bin/configurate -p data/config.php data/config_template/addConfig.sh.php autogen/addConfig.sh $environment
#vendor/bin/configurate -p data/config.php data/config_template/imageTaskRunner.conf.php autogen/imageTaskRunner.conf $environment

vendor/bin/genenv -p data/config.php data/envRequired.php autogen/appEnv.php $environment

vendor/bin/fpmconv autogen/php.ini autogen/php.fpm.ini 

