#!/bin/bash -ex

BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
TESTDIR=/tmp/tests_atoum_std_edition
EXECLOG=$TESTDIR/log_exec_test.log

export TESTDIR
export EXECLOG

cd $BASEDIR

rm -rf tmp
mkdir -p tmp
cp composer.json tmp/
cd tmp
composer update $COMPOSER_PREFER
cd $BASEDIR

for dir in cases/*/
do
    rm -rf $TESTDIR

    dir=${dir%*/}
    CASE=${dir##*/}

    cp -R cases/$CASE $TESTDIR
    cp composer.json $TESTDIR/
    cp tmp/composer.lock $TESTDIR/
    cd $TESTDIR

    composer install

    $TESTDIR/run.sh

    cd $BASEDIR
done
