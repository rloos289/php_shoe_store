<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Shoe.php";

    //Epicodus
    // $server = 'mysql:host=localhost;dbname=shoes_test';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    // home mac
    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase

    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests

    {
        protected function teardown()
        {
            Store::deleteAll();
            Shoe::deleteAll();
        }
//--static function tests--

        function test_getAll()
        {
            $name = "Nike";
            $new_shoe = New Shoe ($name);
            $new_shoe->save();
            $name2 = "Adidas";
            $new_shoe2 = New Shoe ($name2);
            $new_shoe2->save();

            $result = Shoe::getAll();

            $this->assertEquals([$new_shoe, $new_shoe2], $result);
        }

        function test_find()
        {
            $name = "Nike";
            $new_shoe = New Shoe ($name);
            $new_shoe->save();
            $name2 = "Adidas";
            $new_shoe2 = New Shoe ($name2);
            $new_shoe2->save();

            $result = Shoe::find($new_shoe->getId());

            $this->assertEquals($new_shoe,$result);
        }

        function test_deleteAll()
        {
            $name = "Nike";
            $new_shoe = New Shoe ($name);
            $new_shoe->save();
            $name2 = "Adidas";
            $new_shoe2 = New Shoe ($name2);
            $new_shoe2->save();

            Shoe::deleteAll();
            $result = Shoe::getAll();

            $this->assertEquals([],$result);
        }

//--regular function tests
        function test_save()
        {
            $name = "Nike";
            $new_shoe = New Shoe ($name);
            $new_shoe->save();

            $result = Shoe::getAll();

            $this->assertEquals([$new_shoe], $result);
        }

    }

 ?>
