<?php
/**
 * Upload - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;

class Upload {
    function __construct() {}
    /**
     * Create upload directories
     * @return void
     */
    private static function createDirs()
    {
        if (!file_exists(PATH . '/uploads/files/' . date('Y'))) {
            @mkdir(PATH . '/uploads/files/' . date('Y'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/files/' . date('Y') . '/' . date('m'))) {
            @mkdir(PATH . '/uploads/files/' . date('Y') . '/' . date('m'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/photos/' . date('Y'))) {
            @mkdir(PATH . '/uploads/photos/' . date('Y'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/photos/' . date('Y') . '/' . date('m'))) {
            @mkdir(PATH . '/uploads/photos/' . date('Y') . '/' . date('m'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/videos/' . date('Y'))) {
            @mkdir(PATH . '/uploads/videos/' . date('Y'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/videos/' . date('Y') . '/' . date('m'))) {
            @mkdir(PATH . '/uploads/videos/' . date('Y') . '/' . date('m'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/sounds/' . date('Y'))) {
            @mkdir(PATH . '/uploads/sounds/' . date('Y'), 0777, true);
        }
        if (!file_exists(PATH . '/uploads/sounds/' . date('Y') . '/' . date('m'))) {
            @mkdir(PATH . '/uploads/sounds/' . date('Y') . '/' . date('m'), 0777, true);
        }
    }
    /**
     * Valid type of file to folder
     * @return array
     */
    private static function validFolderType(string $file_extension)
    {
        $folder   = 'files';
        $fileType = 'file';
        if ($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif') {
            $folder   = 'photos';
            $fileType = 'image';
        } else if ($file_extension == 'mp4' || $file_extension == 'mov' || $file_extension == 'webm' || $file_extension == 'flv') {
            $folder   = 'videos';
            $fileType = 'video';
        } else if ($file_extension == 'mp3' || $file_extension == 'wav') {
            $folder   = 'sounds';
            $fileType = 'soundFile';
        }

        return array(
            'folder' => $folder,
            'type' => $fileType
        );
    }
    /**
     * Valid FILES upload
     * @return array
     */
    private static function files(array $params)
    {
        if (!isset($params["tmp_name"])) throw new Exception("Invalid FILES");
        if (!isset($params["name"])) throw new Exception("Invalid FILES");

        return array(
            'file' => $params["tmp_name"],
            'name' => $params["name"]
        );
    }
    /**
     * Upload file
     * @return array
     */
    public static function upload(array $params)
    {
        try
        {
            self::createDirs();
            $data = self::files($params);
            $new_string        = pathinfo($data['name'], PATHINFO_FILENAME) . '.' . strtolower(pathinfo($data['name'], PATHINFO_EXTENSION));
            $file_extension    = pathinfo($new_string, PATHINFO_EXTENSION);
            
            $validFolderType = self::validFolderType($file_extension);
            $folder   = $validFolderType['folder'];
            $fileType = $validFolderType['type'];
            $dir         = "uploads/{$folder}";
            $filename    = $dir . '/' . date('Y') . '/' . date('m') . '/' . date('Y-m-d') . '_' . md5(time()) . "_{$fileType}.{$file_extension}";
            if (move_uploaded_file($data['file'], $filename)) return $filename;
            return false;
        }
        catch(Exception $e)
        {
            throw new Exception("Failed to upload: " . $e->getMessage());
        }
    }
    /**
     * Unlink file
     * @return boolean
     */
    public static function unlink(string $path)
    {
        try
        {
            if (empty($path)) throw new Exception("File is empty");
            if (file_exists($path)) {
                @unlink($path);
                return true;
            }
            return false;
        }
        catch(Exception $e)
        {
            throw new Exception("Failed to remove file: " . $e->getMessage());
        }
    }
}
?>