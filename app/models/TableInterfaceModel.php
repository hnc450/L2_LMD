<?php
    namespace App\Models;

    interface TableInterfaceModel{
        public  function all();
        public  function one(int $id);
        // public static function create(array $data): bool;
        // public static function update(int $id, array $data): bool;
        // public static function delete(int $id): bool;
    }

?>