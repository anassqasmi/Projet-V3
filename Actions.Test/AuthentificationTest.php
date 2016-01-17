<?php

require 'Actions/Authentification.php';
		
require 'Controlor/MainControlor.php';


class StackTest extends PHPUnit_Framework_TestCase
{
	
	public function test1()
	{
		//$stack = array();
		//$this->assertEquals(0, count($stack));
		//array_push($stack, 'foo');
		
		$this->assertEquals(true, test('anass', 'anass'));
		
	}
	
	public function test2()
	{
		//$stack = array();
		//$this->assertEquals(0, count($stack));
		//array_push($stack, 'foo');
		
		$this->assertEquals(true, test('anass', 'anass'));
		
	}
}

?>
