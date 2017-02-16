#!/bin/bash -ex

BASEDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
TESTDIR=/tmp/tests_atoum_std_edition
PREPARATIONDIR=/tmp/tests_atoum_std_editon_tmp
EXECLOG=$TESTDIR/log_exec_test.log

export TESTDIR
export EXECLOG

cd $BASEDIR

rm -rf $PREPARATIONDIR
mkdir -p $PREPARATIONDIR
cp composer.json $PREPARATIONDIR
sed --in-place "s#STD_EDITION_DIR#$BASEDIR/../../#" $PREPARATIONDIR/composer.json
cd $PREPARATIONDIR
php $BASEDIR/../../composer.phar update $COMPOSER_PREFER
cd $BASEDIR

for dir in cases/*/
do
    rm -rf $TESTDIR

    dir=${dir%*/}
    CASE=${dir##*/}

    cp -R cases/$CASE $TESTDIR
    cp $PREPARATIONDIR/composer.json $TESTDIR/
    cp $PREPARATIONDIR/composer.lock $TESTDIR/
    cd $TESTDIR

    $BASEDIR/../../composer.phar install

    $TESTDIR/run.sh

    cd $BASEDIR
done
