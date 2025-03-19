#!/bin/bash

set -e

echo "Running migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction

exec php -S 0.0.0.0:8080 -t public
