<?php

namespace app\models\Helpers;

class FileHelper
{
    /**
     * @param int $count
     * @param int $split
     * @return string
     * @throws \Exception
     */
    public static function generateRandomStr(int $count = 13, int $split = 4) : string {
        return implode('-',str_split(bin2hex(random_bytes($count)),$split));
    }

    /**
     * Создание директории если она не существует
     * @param $dir
     * @param $rule
     */
    public static function createFolder($dir,$rule) {
        if(!is_dir($dir)) {
            mkdir($dir, $rule, true);
        }
    }

    /**
     * @param string $image
     * @return string
     */
    public static function getBase64FromImage(string $image) : string {
        return base64_encode(file_get_contents($image));
    }

    /**
     * @param $path
     * @return bool
     */
    public static function rmRec($path) {
        if (is_file($path)) return unlink($path);
        if (is_dir($path)) {
            foreach(scandir($path) as $p) if (($p!='.') && ($p!='..'))
                self::rmRec($path.DIRECTORY_SEPARATOR.$p);
            return rmdir($path);
        }
        return false;
    }
}