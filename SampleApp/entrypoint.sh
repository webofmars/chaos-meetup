#!/bin/sh

set -e -o pipefail

echo "+ sf4 tasks (db dependents)"
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force --no-interaction
[[ "${SF_FIXTURES}" == "true" ]] && php bin/console doctrine:fixtures:load --append --no-interaction
php bin/console cache:warmup
[[ "${APP_ENV}" == "prod" ]] && php bin/console doctrine:ensure-production-settings

echo "+ starting service"
php-fpm -D && nginx -g "daemon off;"