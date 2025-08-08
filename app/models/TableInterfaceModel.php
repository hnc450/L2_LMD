<?php
    namespace App\Models;

    interface TableInterfaceModel{
        // public  function all();
        public  function one(int $id);
        // public  function create(array $data): bool;
        // public  function update(int $id, array $data): bool;
        // public  function delete(int $id): bool;
    }

?>