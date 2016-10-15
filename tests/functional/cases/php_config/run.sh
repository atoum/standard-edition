#!/bin/bash -ex
cd $TESTDIR

./vendor/bin/atoum | tee $EXECLOG
grep "1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions" $EXECLOG
