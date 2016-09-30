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

        function addStore()
        {

        }

        function getStorelist()
        {

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
