#!/bin/bash -ex
cd $TESTDIR

export XUNIT_REPORT_PATH=logs/xunitreport.xml

./vendor/bin/atoum | tee $EXECLOG
grep "1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions" $EXECLOG
grep 'testsuite name="Example" package="myvendor' logs/xunitreport.xml

