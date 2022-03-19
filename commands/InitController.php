<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\base\Exception;
use yii\console\ExitCode;
use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitController extends Controller
{
    /**
     * @return int
     * @throws Exception
     */
    public function actionIndex()
    {
        $dbFolderPath = __DIR__.'/../db';
        echo "Creating DB folder with 0777...\n";
        if(FileHelper::createDirectory($dbFolderPath,0777)===false) {
            echo "ERROR: DB folder is not created!\n";
            exit();
        }
        echo "DB folder was created successfully!\n";
        $uploadFolderPath = __DIR__.'/../upload';
        echo "Creating Upload folder with 0777...\n";
        if(FileHelper::createDirectory($uploadFolderPath,0777)===false) {
            echo "ERROR: Upload folder is not created!\n";
            exit();
        }
        echo "Upload folder was created successfully!\n";
        $productFolderPath = __DIR__.'/../upload/product';
        echo "Creating Product folder with 0777...\n";
        if(FileHelper::createDirectory($productFolderPath,0777)===false) {
            echo "ERROR: Product folder is not created!\n";
            exit();
        }
        echo "Product folder was created successfully!\n";
        return ExitCode::OK;
    }
}
