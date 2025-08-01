<?php
namespace App\Models;

use App\Models\Database\Database;

class SettingModel
{
    public static function getAllAdminSettings() {
      return \App\Models\Database\Database::QueryRequest("SELECT * FROM settings",2);
    }

    public static function getUserSettings($user_id) {
        // $db = Database::getInstance();
        // $stmt = $db->prepare("SELECT * FROM settings WHERE user_id = ?");
        // $stmt->execute([$user_id]);
        // return $stmt->fetchAll();
    }

    public static function saveSetting($name, $value, $user_id) {
        $existing = \App\Models\Database\Database::executeQuery('SELECT * FROM settings WHERE setting_name = ?',[$name],2);
      
        if ($existing){
            $_SESSION['message'] = "ce paramettre existe deja";
            \App\Models\Database\Database::executeQuery('UPDATE settings SET setting_value = ? WHERE id = ?',[$value, $existing['id']],3);
            header('Location: /administration/settings');
        } else {
            $_SESSION['message'] = "paramettre ajouté avec success";
            \App\Models\Database\Database::executeQuery('INSERT INTO settings (setting_name, setting_value, user_id) VALUES (?, ?, ?)',[$name, $value, $user_id],1);
              header('Location: /administration/settings');
        }
    }

    public static function deleteSetting($id) {
          $_SESSION['message'] = "parametre supprimé avec succès";
          \App\Models\Database\Database::executeQuery('DELETE FROM settings WHERE id = ?',[$id],4);
    }
    public static function updateSetting($id, $valeur){
        \App\Models\Database\Database::executeQuery('UPDATE settings SET setting_value = :valeur WHERE id = :id',[':valeur'=> $valeur, ':id'=>$id],3);
        // echo json_encode(['success' => true, 'message' => 'Paramètre mis à jour']);
    }
}