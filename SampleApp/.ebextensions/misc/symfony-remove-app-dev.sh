#!/bin/bash

set -e

case ${SYMFONY_ENV} in
    prod)
        echo "PROD env so removing it"
        rm web/app_dev.php
        ;;
    dev)
        echo "DEV env so skipping removal"
        ;;
    *)
        echo "UNKNOWN env (${SYMFONY_ENV}) so skipping removal"
        ;;
esac