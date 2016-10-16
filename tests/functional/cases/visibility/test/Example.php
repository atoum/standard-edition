<?php

namespace myvendor\myproject\tests\units;

class Example extends \atoum
{
	public function testVisiblityIsLoaded()
	{
		$this
			->given($example = new \myvendor\myproject\Example())
			->string($this->invoke($example)->protegee())
			->isIdenticalTo('content')
		;
	}
}

