<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

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

    class BrandTest extends PHPUnit_Framework_TestCase

    //run test in terminal: ./vendor/bin/phpunit tests

    //on Mac: run: export PATH=$PATH:./vendor/bin
    //then run phpunit tests

    {
        protected function teardown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }
//--static function tests--

        function test_getAll()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();
            $name2 = "Adidas";
            $new_brand2 = New Brand ($name2);
            $new_brand2->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_find()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();
            $name2 = "Adidas";
            $new_brand2 = New Brand ($name2);
            $new_brand2->save();

            $result = Brand::find($new_brand->getId());

            $this->assertEquals($new_brand,$result);
        }

        function test_deleteAll()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();
            $name2 = "Adidas";
            $new_brand2 = New Brand ($name2);
            $new_brand2->save();

            Brand::deleteAll();
            $result = Brand::getAll();

            $this->assertEquals([],$result);
        }

//--regular function tests
        function test_save()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand], $result);
        }

//--join table functions
        function test_addStore()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();

            $new_brand->addStore($new_store);
            $result = $new_brand->getStorelist();

            $this->assertEquals([$new_store],$result);
        }

        function test_getStorelist()
        {
            $name = "Nike";
            $new_brand = New Brand ($name);
            $new_brand->save();
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            $new_brand->addStore($new_store);
            $new_brand->addStore($new_store2);
            $result = $new_brand->getStorelist();

            $this->assertEquals([$new_store, $new_store2],$result);
        }

    }

 ?>
