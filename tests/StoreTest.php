<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    // require_once "src/Shoe.php";

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

    class StoreTest extends PHPUnit_Framework_TestCase

    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests

    {
//--static function tests--
        protected function teardown()
        {
            Store::deleteAll();
            // Shoe::deleteAll();
        }

        function test_getAll()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store, $new_store2], $result);
        }

        function test_find()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            $result = Store::find($new_store->getId());

            $this->assertEquals([$new_store],$result);
        }


//--regular function tests
        function test_save()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store], $result);
        }
    }

 ?>
