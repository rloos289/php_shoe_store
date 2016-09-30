<?php
    class Brand
    {
        private $name;
        private $id;

//--construct--
        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

//--static functions--

        static function getall()
        {
            $brand_array = array();
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            foreach ($returned_brands as $brand)
            {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = New Brand ($name, $id);
                array_push($brand_array, $new_brand);
            }
            return $brand_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach ($brands as $brand)
            {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                  $found_brand = $brand;
                }
            }
            return $found_brand;
        }

//--regular functions--

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

//--join table functions

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO store_brands (store_id, brand_id) VALUES ({$this->id}, {$store->getId()});");
        }

        function getStorelist()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN stores_brands ON (stores_brands.brand_id = store.id)
                JOIN stores ON (brand.id = stores_brands.brand_id)
                WHERE store.id = {$this->getId()};");

            $store_array = array();
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            foreach ($returned_stores as $store)
            {
                $id = $store['id'];
                $name = $store['name'];
                $new_store = New Store ($name, $id);
                array_push($store_array, $new_store);
            }
            return $store_array;
        }

        function deleteStore()
        {

        }

//--getters and setters--
        function setName($name)
        {
            $this->name = $name;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }
    }
?>
