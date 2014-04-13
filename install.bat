php composer.phar install

cd \
mkdir php
cd php
mkdir pear
cd pear
mkdir docs
cd docs
mkdir PHPUnit
cd c:\xampp\php
pear update-channels
pear channel-discover pear.phpunit.de
pear install --alldeps phpunit/PHPUnit
rmdir c:\php /s