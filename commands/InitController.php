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
        $dbName = "test.db";
        $dbFolderPath = dirname(__DIR__).'/db';
        $dbPath = "$dbFolderPath/$dbName";
        if(file_exists($dbPath)) {
            echo "DB $dbName already exists\n";
            exit;
        }
        echo "Creating DB $dbName...\n";
        if(FileHelper::createDirectory($dbFolderPath,0777)===false) {
            echo "ERROR: DB folder is not created!\n";
            exit;
        }
        new \SQLite3($dbPath);
        if(!file_exists($dbPath)) {
            echo "ERROR: DB $dbName is not created!\n";
            exit;
        }
        echo "DB $dbName was created successfully!\n";
        return ExitCode::OK;
    }
}
