<?php
namespace App\Middlewares\Upload;
/**
 * Middleware pour l'upload sécurisé des images
 */
class Upload
{
    /**
     * Gère l'upload d'une image
     * @param array $file Le fichier du formulaire ($_FILES['image'])
     * @param string $uploadDir Dossier de destination (ex: 'public/uploads/')
     * @param int $maxSize Taille max en octets (ex: 2Mo = 2*1024*1024)
     * @return string|false Le chemin du fichier uploadé ou false en cas d'erreur
     */
    public static function upload_image(array $file, string $uploadDir, int $maxSize = 2097152)
    {
        // Vérifier l'existence du fichier
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        // Vérifier la taille
        if ($file['size'] > $maxSize) {
            return false;
        }
        // Vérifier le type MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mime, $allowed)) {
            return false;
        }
        // Générer un nom unique
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_', true) . '.' . $ext;
        // Créer le dossier si besoin
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $dest = rtrim($uploadDir, '/') . '/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return $dest;
        }
        return false;
    }

    /**
     * Supprime une image de façon sécurisée
     * @param string $filepath Chemin du fichier à supprimer
     * @return bool
     */
    public static function delete_image(string $filepath): bool
    {
        if (file_exists($filepath) && strpos($filepath, 'uploads') !== false) {
            return unlink($filepath);
        }
        return false;
    }
}
?> 