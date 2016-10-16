<?php

namespace myvendor\myproject\tests\units;

class Example extends \atoum
{

	public function testDoSomething()
	{
		$this
			->given($example = new \myvendor\myproject\Example())
			->integer($example->doSometing())
				->isEqualTo(40)
		;
	}
}

