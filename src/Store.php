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

        }

//--regular functions--

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {

        }

        function update()
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
