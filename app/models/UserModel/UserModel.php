<?php 
    namespace App\Models\UserModel;
    
    class UserModel{

        private int $id_user;
        private string $peudo;
        private string $email;
        private string $mdp;
        private bool $status;
        private string $role;
        private string $genre;
        private $age;
        private string $avatar;

        public function getUser($id){
            return \App\Models\Database\Database::executeQuery('SELECT * FROM users WHERE id_user=:id',[':id' => $id],2)[0];
        }

    }

?>