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

        }

        static function deleteAll()
        {

        }

        static function find()
        {

        }

//--regular functions--

        function save()
        {

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
