<?php 
    namespace App\Models\UserModel;
    
    class UserModel implements \App\Models\TableInterfaceModel{

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

        /**
         * Récupère un utilisateur par son ID.
         * Implémente la méthode de l'interface TableInterfaceModel.
         */
        public function one(int $id)
        {
           return \App\Models\Database\Database::executeQuery('SELECT * FROM users WHERE id_user=:id',[':id' => $id],2)[0];
        }

        // Modèle UserModel amélioré : gestion CRUD, validation, typage strict, hash mot de passe

        /**
         * Crée un nouvel utilisateur dans la base de données.
         * Hash le mot de passe avant insertion.
         */
        public static function create(array $data): bool
        {
            if (!self::validate($data)) return false;
            // Vérifier unicité email
            $exists = \App\Models\Database\Database::executeQuery('SELECT id_user FROM users WHERE email = :email', [':email' => $data['email']], 2);
            if ($exists) return false;
            $data['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);
            return \App\Models\Database\Database::executeQuery(
                'INSERT INTO users (peudo, email, mdp, status, role, genre, age, avatar) VALUES (:peudo, :email, :mdp, :status, :role, :genre, :age, :avatar)',
                [
                    ':peudo' => $data['peudo'],
                    ':email' => $data['email'],
                    ':mdp' => $data['mdp'],
                    ':status' => $data['status'] ?? 1,
                    ':role' => $data['role'] ?? 'joueur',
                    ':genre' => $data['genre'] ?? '',
                    ':age' => $data['age'] ?? null,
                    ':avatar' => $data['avatar'] ?? '/public/assets/avatar.png',
                ],
                1
            );
        }
        /**
         * Récupère tous les utilisateurs.
         * Implémente la méthode de l'interface TableInterfaceModel.
         */
   
        public function all(){
             return \App\Models\Database\Database::QueryRequest('SELECT * FROM users', 2);
        }

        /**
         * Met à jour un utilisateur existant.
         */
        public static function update(int $id, array $data): bool
        {
            // On ne met à jour le mot de passe que s'il est fourni
            $fields = [
                'peudo' => $data['peudo'],
                'email' => $data['email'],
                'status' => $data['status'] ?? 1,
                'role' => $data['role'] ?? 'joueur',
                'genre' => $data['genre'] ?? '',
                'age' => $data['age'] ?? null,
                'avatar' => $data['avatar'] ?? '/public/assets/avatar.png',
            ];
            $set = 'peudo = :peudo, email = :email, status = :status, role = :role, genre = :genre, age = :age, avatar = :avatar';
            if (!empty($data['mdp'])) {
                $fields['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);
                $set .= ', mdp = :mdp';
            }
            $fields['id'] = $id;
            return \App\Models\Database\Database::executeQuery(
                "UPDATE users SET $set WHERE id_user = :id",
                $fields,
                3
            );
        }

        /**
         * Supprime un utilisateur par son ID.
         */
        public static function delete(int $id): bool
        {
            return \App\Models\Database\Database::executeQuery('DELETE FROM users WHERE id_user = :id', [':id' => $id], 4);
        }

        /**
         * Valide les données d'un utilisateur (exemple simple).
         */
        public static function validate(array $data): bool
        {
            return !empty($data['peudo']) && !empty($data['email']) && !empty($data['mdp']);
        }

    }

?>