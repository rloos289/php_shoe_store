<?php
    class Store
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach ($stores as $store)
            {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                  $found_store = $store;
                }
            }
            return $found_store;
        }

//--regular functions--

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function update($name)
        {
            $this->name = $name;
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$this->name}' WHERE id = {$this->getId()};");
        }

//--join table functions

        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->id}, {$brand->getId()});");
        }

        function deleteBrand($brand)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->id} AND brand_id = {$brand->getId()};");
        }

        function getBrandlist()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN stores_brands ON (stores_brands.store_id = stores.id)
                JOIN brands ON (brands.id = stores_brands.brand_id)
                WHERE stores.id = {$this->getId()};");

            $brand_array = array();
            foreach ($returned_brands as $brand)
            {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = New Brand ($name, $id);
                array_push($brand_array, $new_brand);
            }
            return $brand_array;
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
