#!/bin/bash -ex
cd $TESTDIR

# we check if the yaml file is used before the php file

./vendor/bin/atoum 2>&1 | tee $EXECLOG
grep "Unable to read test directory" $EXECLOG
