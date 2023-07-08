## Dev Environment

### Initial Installation

Initial steps that installed minimum Laravel/Sail/Breeze functionality; not to be repeated.

```shell
composer create-project laravel/laravel {project}
cd {project}
composer require laravel/sail --dev
php artisan sail:install (mariadb,mailhog)
composer require laravel/breeze --dev
vendor/bin/sail artisan breeze:install vue
```

### Setup

```shell
composer install
npm install
cp .env.dev .env
```

Edit `.env` to set correct values for `CMS_BASE_URL` and `CMS_TOKEN`.

```shell
vendor/bin/sail up
vendor/bin/sail artisan migrate
```

### Run

```shell
vendor/bin/sail up
```

Also start Vite in a separate terminal:

```shell
npm run dev
```

## Deployment

Before final commit:

```shell
npm run build
```

Example deployment steps:

```shell
USER_ROOT={user_root}
WEBROOT={webroot}
DEPLOYS_ROOT_DIR={deploys_dir}
PERSIST_DIR={persist_dir}

TIMESTAMP=$(date +%s)
DEPLOY_DIR=${DEPLOYS_ROOT_DIR}/lylaslog_${TIMESTAMP}
DEPLOY_PUB_DIR=${DEPLOY_DIR}/public

git clone git@github.com:CNanninga/lylaslog-com.git $DEPLOY_DIR
cd $DEPLOY_DIR
ln -s ${PERSIST_DIR}/.env ${DEPLOY_DIR}/.env
(First time only) rsync -av ${DEPLOY_DIR}/storage/ ${PERSIST_DIR}/storage/
rm -r ${DEPLOY_DIR}/storage
ln -s ${PERSIST_DIR}/storage ${DEPLOY_DIR}/storage
~/bin/composer.phar install --optimize-autoloader --no-dev
npm install
php artisan config:cache
php artisan view:cache

cd $WEBROOT
php artisan down
cd $USER_ROOT
rm $WEBROOT && ln -s $DEPLOY_PUB_DIR $WEBROOT
cd $DEPLOY_DIR
php artisan migrate --force
php artisan up
```

## Hosting Setup

1. Point domain to host nameservers.
2. Add SSH key
3. Whitelist IP address
4. Create database
5. Issue SSL cert
6. Force HTTPS redirect
7. Make sure php, mysql client, node/npm are installed
8. Install latest Composer in `~/bin`
9. Make sure required PHP extensions are loaded
10. Create .env and storage directory
11. Copy scripts/deploy.sh into place and make executable
