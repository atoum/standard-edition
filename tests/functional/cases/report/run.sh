#!/bin/bash -ex
cd $TESTDIR

./vendor/bin/atoum | tee $EXECLOG
grep 'coverage version="1"' sonar-clover.xml
grep 'testCase name="testDoSomething' sonar-xunit.xml
