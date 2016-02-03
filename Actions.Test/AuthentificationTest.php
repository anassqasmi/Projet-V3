<?php

require 'Actions/Authentification.php';

require 'DAO/FileAccess.php';

require 'Controlor/MainControlor.php';

//$_POST['id'] = "1";
//$_POST['nom'] = "2";

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
	
	public function testDeleteTags1()
	{
		$this->assertEquals(1, loooooool());
	}
	
	public function testEmail($id)
	{
		$this->assertEquals(true, Email($id);
	}
	
	public function testPWD($pwd)
	{
		$this->assertEquals(true, PWD($pwd));
	}
	
	public function testNom($nom)
	{
		$this->assertEquals(true, testNom($nom));
	}
	
	public function testPreomExist($nom)
	{
		$this->assertEquals(true, PrenomExist($nom));
	}
	
	
	
	
	/*public function deleteTags($id)
	{
		if (!isset($id))
		{
			return false;
		}else{
			return true;
		}
	}*/
}

?>
