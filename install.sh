#!bin/sh
echo 'create .env'
cp -n .env.example .env

#echo 'set git hooks'
#cp Igor/git-hooks/* .git/hooks/
#chmod 755 .git/hooks/*

echo 'install npm modules'
# Global
npm i -g grunt eslint
# package.json
npm i

echo 'install composer modules'
php composer.phar install