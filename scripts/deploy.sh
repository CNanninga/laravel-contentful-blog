#! /usr/bin/bash

USER_ROOT={user_root}
WEBROOT=${USER_ROOT}/public_html
DEPLOYS_ROOT_DIR=${USER_ROOT}/application/deploys
PERSIST_DIR=${USER_ROOT}/application/persist

TIMESTAMP=$(date +%s)
DEPLOY_DIR=${DEPLOYS_ROOT_DIR}/blog_${TIMESTAMP}
DEPLOY_PUB_DIR=${DEPLOY_DIR}/public

git clone https://github.com/CNanninga/laravel-contentful-blog.git $DEPLOY_DIR
cd $DEPLOY_DIR
ln -s ${PERSIST_DIR}/.env ${DEPLOY_DIR}/.env
rm -r ${DEPLOY_DIR}/storage
ln -s ${PERSIST_DIR}/storage ${DEPLOY_DIR}/storage
${USER_ROOT}/bin/composer.phar install --optimize-autoloader --no-dev
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
