<?php

require 'Actions/Authentification.php';

require 'DAO/FileAccess.php';

require 'Controlor/MainControlor.php';

//test class
class StackTest extends PHPUnit_Framework_TestCase
{
	
	public function testGroupesTest()
	{
		//$stack = array();
		//$this->assertEquals(0, count($stack));
		//array_push($stack, 'foo');
	
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		//$this->assertEquals('ok', readGroups2());
		$this->assertEquals(true, test('anas1', 'anass'));
	
	}
	
	public function test2()
	{
		//$stack = array();
		//$this->assertEquals(0, count($stack));
		//array_push($stack, 'foo');
		
		$this->assertEquals(true, test('anass', 'anass'));
		$this->assertEquals(true, test('anass', 'anass'));
			$this->assertEquals(true, test('anass', 'anass'));
				$this->assertEquals(true, test('anass', 'anass'));
					$this->assertEquals(true, test('anass', 'anass'));
						$this->assertEquals(true, test('anass', 'anass'));
	}
}
//
?>
