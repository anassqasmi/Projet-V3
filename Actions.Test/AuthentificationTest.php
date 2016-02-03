<?php

require 'Actions/Authentification.php';

require 'DAO/FileAccess.php';

require 'Controlor/MainControlor.php';

$_POST['id'] = "1";
$_POST['nom'] = "2";

//test class
class StackTest extends PHPUnit_Framework_TestCase
{
	
public function testGroupesTest()
	{
		$this->assertEquals(true, test('anass', 'anass'));
	
	}
	
	public function test2()
	{
		$this->assertEquals(true, test('anass', 'anass'));
	}
	
	public function testDeleteTags()
	{
		$this->assertEquals(true, deleteTag($_POST['id']));
	}
	
	
	
	function deleteTag($id)
	{
		if (isset($id))
		{
			return true;
		}else {
			return false;
		}
	}
	
	function deleteTagg($id)
	{
		if (!isset($id))
		{
			return false;
		}else{
			return true;
		}
	}
}

?>
