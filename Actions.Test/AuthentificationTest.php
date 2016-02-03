<?php

require 'Actions/Authentification.php';

require 'DAO/FileAccess.php';

require 'Controlor/MainControlor.php';

//$_POST['id'] = "1";
//$_POST['nom'] = "2";
$nom = "anass";
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
		$this->assertEquals(1, tagvir());
	}
	
	public function testEmail()
	{
		$id = "anass@gmail.com";
		$this->assertEquals(true, Email($id));
	}
	
	public function testPWD()
	{
		$pwd = "9817dfsSS3";
		$this->assertEquals(true, PWD($pwd));
	}
	
	public function testNom()
	{
		$nom = "Boukaibat";
		$this->assertEquals(true, testNom($nom));
	}
	
	public function testPrenomExist()
	{
		$nom = "anass";
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
	
	
function testdifTag()
{
	$tag = "exist";
	return difTag($tag);
}

function testcheckuser()
{
	$id = "123";
	return checkuser($id);
}
	
function testcheckFile()
{
	$filename = "DAOFile";
	return checkFile($filename);
}

function testvirLog()
{
	$nom = "log";
	return virLog($nom);
}

function testfileExist()
{
	$variable = "File";
	return fileExist($variable);	
}

?>
