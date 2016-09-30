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
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id, store_id) VALUES ({$this->id}, {$store->getId()});");
        }

        function getStorelist()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN stores_brands ON (stores_brands.brand_id = brands.id)
                JOIN stores ON (stores.id = stores_brands.store_id)
                WHERE brands.id = {$this->getId()};");
                //query doesnt throw errors but doesnt seem to make connection either

            $store_array = array();
            foreach ($returned_stores as $store)
            {
                $id = $store['id'];
                $name = $store['name'];
                $new_store = New Store ($name, $id);
                array_push($store_array, $new_store);
            }
            return $store_array;
        }

        function deleteStore($store)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->id} AND store_id = {$store->getId()};");

            // $GLOBALS['DB']->exec("DELETE FROM students_courses WHERE course_id = {$this->id} AND student_id = {$student->getId()}; ");
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
