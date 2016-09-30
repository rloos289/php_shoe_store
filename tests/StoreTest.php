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

    class StoreTest extends PHPUnit_Framework_TestCase

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

        function test_store_getAll()
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

        function test_store_find()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            $result = Store::find($new_store->getId());

            $this->assertEquals($new_store,$result);
        }

        function test_store_deleteAll()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([],$result);
        }

//--regular function tests
        function test_store_save()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store], $result);
        }

        function test_store_delete()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $name2 = "Payless";
            $new_store2 = New Store ($name2);
            $new_store2->save();

            $new_store->delete();
            $result = Store::getAll();

            $this->assertEquals([$new_store2], $result);
        }

        function test_store_update()
        {
            $name = "Nordstrom";
            $new_store = New Store ($name);
            $new_store->save();
            $new_store->update("Nordstrom Rack");

            $result = $new_store->getName();

            $this->assertEquals("Nordstrom Rack", $result);
        }
//--join table functions

        function test_store_addBrand()
        {
            $store_name = "Nordstrom";
            $new_store = New Store ($store_name);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = New Brand ($brand_name);
            $new_brand->save();

            $new_store->addBrand($new_brand);
            $result = $new_store->getBrandlist();

            $this->assertEquals([$new_brand], $result);
        }

        function test_store_getBrandList()
        {
            $store_name = "Nordstrom";
            $new_store = New Store ($store_name);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = New Brand ($brand_name);
            $new_brand->save();
            $brand_name2 = "Adidas";
            $new_brand2 = New Brand ($brand_name2);
            $new_brand2->save();

            $new_store->addBrand($new_brand);
            $new_store->addBrand($new_brand2);
            $result = $new_store->getBrandlist();

            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_store_deleteBrand()
        {
            $store_name = "Nordstrom";
            $new_store = New Store ($store_name);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = New Brand ($brand_name);
            $new_brand->save();
            $brand_name2 = "Adidas";
            $new_brand2 = New Brand ($brand_name2);
            $new_brand2->save();

            $new_store->addBrand($new_brand);
            $new_store->addBrand($new_brand2);
            $new_store->deleteBrand($new_brand);
            $result = $new_store->getBrandlist();

            $this->assertEquals([$new_brand2], $result);
        }
    }

 ?>
