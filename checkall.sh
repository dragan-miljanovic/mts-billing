#!/bin/bash
# Check if .env exists, if not, copy .env.example to .env
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
        echo ".env.example has been copied to .env"
    else
        echo "Error: .env.example does not exist."
        exit 1
    fi
else
        echo ".env.example has been already copied to .env"
fi

# Check if vendor directory exists, if not, run composer install
if [ ! -d vendor ]; then
    echo "Vendor directory not found. Running composer install..."
    echo "=================Composer install=================="
composer install
else
    echo "Vendor directory already exists. Skipping composer install."
fi
echo "======Artisan key:generate========="
# Check if APP_KEY is already set in .env
if grep -q '^APP_KEY=' .env && [ -n "$(grep '^APP_KEY=' .env | cut -d '=' -f2)" ]; then
    echo "APP_KEY is already set. Skipping key generation."
else
    echo "APP_KEY is not set. Generating key..."
    php artisan key:generate
fi
echo "======Run migrations========="
php artisan migrate:fresh
echo "=================Artisan optimize:clear====================="
php artisan optimize:clear
