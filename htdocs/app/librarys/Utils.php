<?php

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
class Utils extends Phalcon\Mvc\User\Component
{

    /**
     * Builds Translate
     *
     * @return CustomeTranslate
     */
    public static function getTranslate($dir, $controllerName, $actionName, $language)
    {
        $messages = array();
        //$language = '';
        $path = "$dir$language/common.php";
        if (file_exists( $path )) {
            require ($path);
            $messages = array_merge($messages, $moduleMessages);
        }

        $path = "$dir$language/$controllerName/common.php" ;

        if (file_exists( $path)) {
            require ($path);
            $messages = array_merge($messages, $moduleMessages);
        } else {
            $path = $dir . "ja/$controllerName/common.php" ;

            if (file_exists( $path)) {
               require($path);
               $messages = array_merge($messages, $moduleMessages);
            }
        }

        $path = "$dir$language/$controllerName/$actionName.php" ;

        if (file_exists( $path)) {
            require ($path);
            $messages = array_merge($messages, $moduleMessages);
        } else {
            $path = $dir . "ja/$controllerName/$actionName.php" ;

            if (file_exists( $path)) {
               require($path);
               $messages = array_merge($messages, $moduleMessages);
            }
        }


        return $translatedb = new CustomTranslate(array(
            "content" => $messages
        ));
    }
    
    public static function sendYoyakuMail($kamoku_id, $date, $time) {
        if($date != date('Y-m-d')) {
            return;
        }
        $kamoku = Kamoku::get($kamoku_id);
        $setting = $kamoku->getBaseYoyakuSetting();
        
        $calendar = $kamoku->getCalendarDate($date);
        
        $current = new DateTime();
        $current->add(new DateInterval('PT' . Consts::MAILSENDTIME . 'M'));
        
        $startTime = NULL;
        if($time == Consts::AMTIME && $calendar->am_fromtext) {
            $startTime = new DateTime("$date " . $calendar->am_fromtext . ':00');
        } elseif($time == Consts::PMTIME && $calendar->pm_fromtext) {
            $startTime = new DateTime("$date " . $calendar->pm_fromtext . ':00');
        } else {
            return;
        }
        
        if($current < $startTime) {
            return;
        }
        
        $firstAccept = Yoyaku::getLastAccept($kamoku_id, $date, $time);
        $noneaccept = Yoyaku::getFirstNoneSendMailObject($kamoku_id, $date, $time);
        $yoyakuNo = '';
        if($firstAccept) {
            $yoyakuNo = $firstAccept->yoyaku_no;
        }

        if($noneaccept) {
            $sendMailCsl=new BaseMail();
            $list = Yoyaku::getSendMailList($kamoku_id, $date, $time, $noneaccept->seq, $setting->time);
            foreach($list as $yoyaku) {
               if($yoyaku->mail == Consts::MAILUNSEND && $yoyaku->type ==Consts::AMPM) {
                   $di = Phalcon\DI::getDefault();
                   $config = $di->getShared('commonconfig');
                   $patient = Patient::get($yoyaku->patient_id);
                   if($patient && $patient->status == Consts::ACTIVE && $patient->email) {
                       $title   = $setting->infoTitle;
                       $message = $setting->infoMessage;
                       $message = str_replace("%N%", $yoyaku->yoyaku_no, $message);
                       $message = str_replace("%Y%", $yoyakuNo, $message);
                       $sendMailCsl->sendMail($config->mail->from, $patient->email, $title, $message);
                       $yoyaku->mail = Consts::MAILSEND;
                       $yoyaku->save();
                   }
                }
            }
        }
    }

    public static function searchZip($zipcode)
    {
        $data = array('success'=>true, 'data' => array(), 'message' => '');
        $zip     = Zip::get($zipcode);
        if($zip) {
            $data['state'] = $zip->state;
            $data['city']  = $zip->city;
            $data['town']  = $zip->town;
        } else {
            $data['success'] = false;
            $data['message'] = '住所が見つかりませんでした。';
        }
        return $data;
    }
    
    public static function getDateTime() {
        //return new DateTime('2014-09-30 11:29');
        return new DateTime();
    }
    
    public static function createOwnerAccount($id) {
        if(!$id) {
            return null;
        }
        return sprintf('%05d', $id);
    }
    
    /**
     *
     * @param $val string
     * @return string
     */
    public static function aes_encrypt($val)
    {
        $key = Utils::mysql_aes_key(Consts::BANNERMODULE);
        $pad_value = 16-(strlen($val) % 16);
        $val = str_pad($val, (16*(floor(strlen($val) / 16)+1)),chr($pad_value));
        return \mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $val, MCRYPT_MODE_ECB
        , mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
    }

    /**
     *
     * @param $val string
     * @return string
     */
    public static function aes_decrypt($val)
    {
        $key = Utils::mysql_aes_key(Consts::BANNERMODULE);//Consts::BANNERMODULE
        $val = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $val,MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB),MCRYPT_DEV_URANDOM));
        $trimData = '';
        for($i=0;$i<17;$i++) {
            $trimData .= chr($i);
        }

        return rtrim($val, $trimData);
    }

    /**
     *
     * @param $key string
     * @return Ambigous <boolean, string>
     */
    public static function mysql_aes_key($key)
    {
        $new_key = str_repeat(chr(0), 16);
        for($i=0,$len=strlen($key);$i<$len;$i++)
        {
            $new_key[$i%16] = $new_key[$i%16] ^ $key[$i];
        }
        return $new_key;
    }
    
    /**
     * number to vendorKey
     *
     * @param $venderId    int
     * @return string
     */
    public static function formatVendorKey($vendorId)
    {
    	if(is_numeric($vendorId)) {
    		return sprintf('%05d', $vendorId);
    	}
    	return null;
    }
    
    /**
     * create vendor database
     *
     * @param $dbName    string
     * @return bool
     */
    public static function createVendorDB($newDatabase)
    {
        $di = Phalcon\DI::getDefault();
        $config = $di->get('commonconfig');
        
        $pdo = $di->getShared('systemdb');
        $pdo->query("CREATE DATABASE IF NOT EXISTS $newDatabase");
        
        //$pdo->query("use $newDatabase");
        
        $di->setShared('vendorDB', function () use ($config, $newDatabase) {
            $dbAdapter = new DbAdapter(array(
            'host' => $config->database->host,
            'username' => $config->database->userName,
            'password' => $config->database->password,
            'dbname'   => $newDatabase,
            'charset' => $config->database->charset
            ));  
            return $dbAdapter;
        });
        
        $pdo = $di->getShared('vendorDB');

        
        define('TABLE', 0);
        define('TABLE_FIELD', 1);
        define('TABLE_FIELD_OLD', 2);
        define('TABLE_TYPE', 3);
        define('TABLE_SIZE', 4);
        define('TABLE_NULL', 5);
        define('TABLE_UNIQUE', 6);
        define('TABLE_DEFAULT', 7);
        
        $first    = true;

        $csv = $config->application->batchDir . 'schema.csv';


        $list = array();
        $exsistTables  = array();
        $schemaTables = array();

        try{
            //$sql = "SHOW TABLES FROM $newDatabase";
            $sql = "SHOW TABLES FROM c_00002";
            
            $rs = $pdo->query($sql);
            $exsistTables = array();
            while($row = $rs->fetch(\PDO::FETCH_COLUMN)) {
               $exsistTables[] = $row;
            }

            //if(in_array($tb_name,$table)){
            
            $file = fopen($csv, 'r');
            
            while ($array = fgetcsv( $file )) {
                if($first) {
                    $first = false;
                } else {
                    if(count($array) > TABLE_DEFAULT && $array[TABLE] != '') {
                        if(!isset($list[$array[TABLE]])) {
                            $list[$array[TABLE]] = array();
                            $schemaTables[] = $array[TABLE];
                        }
                        $list[$array[TABLE]][] = $array;
                    }
                }
            }

            fclose($file);
            

            foreach($schemaTables as $table) {

                if(in_array($table, $exsistTables)){
                    $schemas = $list[$table];
                    //echo "update {$table}\n";
                    
                    //既存テーブルカラムリスト
                    $columns = array();
                    
                    $rows = $pdo->query("DESCRIBE  `$table`");
                    
                    foreach($rows as $row) {
                         $columns[] = $row['Field'];
                    }
                    
                    $pre = '';
                    
                    foreach($schemas as $schema) {
                        $null = 'NOT NULL';
                        $default = '';
                        $after = '';
                        $tran  = 'CHANGE';
                        $columnNameOld = '';
                        
                        if(!in_array($schema[TABLE_FIELD], $columns)) {
                            if(in_array($schema[TABLE_FIELD_OLD], $columns)) {
                                $columnNameOld = "`{$schema[TABLE_FIELD_OLD]}`";
                            } else {
                                $after = "AFTER  `$pre`";
                                $tran  = 'ADD';
                            }
                        } else {
                            $columnNameOld = "`{$schema[TABLE_FIELD]}`";
                        }
                        
                        if($schema[TABLE_NULL]) {
                            $null = 'NULL';
                        }
                        
                        if(trim($schema[TABLE_DEFAULT]) !== '') {
                            $default = "DEFAULT '{$schema[TABLE_DEFAULT]}'";
                        }
                        
                        if(mb_strtolower($schema[TABLE_FIELD]) == 'id') {
                            $sql = "ALTER TABLE  `$table` $tran $columnNameOld `id` {$schema[TABLE_TYPE]} unsigned NOT NULL AUTO_INCREMENT $after";
                        } elseif (strpos($schema[TABLE_TYPE], 'int') === TRUE) {
                            $sql = "ALTER TABLE  `$table` $tran $columnNameOld `{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]} UNSIGNED $null $default $after";
                        } elseif($schema[TABLE_SIZE]) {
                            $sql = "ALTER TABLE  `$table` $tran $columnNameOld `{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]}( {$schema[TABLE_SIZE]} ) $null $default $after";
                        } else {
                            $sql = "ALTER TABLE  `$table` $tran $columnNameOld `{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]} $null $default $after";
                        }
                        
                        $pdo->query($sql);
                        
                        $pre = $schema[TABLE_FIELD];
                    }
                } else {
                    //table not exist!
                    //echo "create {$table}\n";
                    
                    $sql = "CREATE TABLE `$table` (";
                    $schemas = $list[$table];
                    
                    $primaryExist = false;
                    $unique       = '';
                    
                    foreach($schemas as $schema) {
                        $null = 'NOT NULL';
                        $default = '';
                        
                        if($schema[TABLE_NULL]) {
                            $null = 'NULL';
                        }
                        
                        if($schema[TABLE_DEFAULT] !== '') {
                            $default = "DEFAULT '{$schema[TABLE_DEFAULT]}'";
                        }
                        
                        if($schema[TABLE_UNIQUE]) {
                            $unique .= " UNIQUE KEY `{$schema[TABLE_FIELD]}` (`{$schema[TABLE_FIELD]}`),";
                        }
                        
                       
                        
                        if(mb_strtolower($schema[TABLE_FIELD]) == 'id') {
                            $sql .= "`id` {$schema[TABLE_TYPE]} unsigned  NOT NULL AUTO_INCREMENT,";
                            $primaryExist = true;
                        } elseif (strpos($schema[TABLE_TYPE], 'int') === TRUE) {
                            $sql .= "`{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]} UNSIGNED $null $default,";
                        } elseif($schema[TABLE_SIZE]) {
                            $sql .= "`{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]}( {$schema[TABLE_SIZE]} ) $null $default,";
                        } else {
                            $sql .= "`{$schema[TABLE_FIELD]}` {$schema[TABLE_TYPE]} $null $default,";
                        }
                    }
                    
                    if($primaryExist) {
                        $sql .= "PRIMARY KEY (`id`),";
                    }
                    
                    if($unique) {
                        $sql .= $unique;
                    }
                    
                    $sql = trim($sql, ',');
                    $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                    
                    $pdo->query($sql);
                }
            }
        } catch (PDOException $e) {
           print $e->getMessage();
           die();
        }
        
        
        return true;
    }
    
    /**
     * output Json Data
     *
     * @param $resoponseCode    string
     * @param $resoponseBody    variable
     * @param $resoponseMessage string
     * @return string
     */
    public static function sendJson($resoponseBody = array(), $resoponseCode = '', $resoponseMessage = '')
    {
        header('Content-type: application/jsonp; charset=utf-8"');

        $resonseHeader = array();
        $dispatcher    = \Phalcon\DI\FactoryDefault::getDefault()->getShared('dispatcher');
        $config        = \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');

        $returnCode  = $config->application->codePreFix;
        $returnCode .= '-' . $dispatcher->getControllerName();
        $returnCode .= '-' . $dispatcher->getActionName();

        if($resoponseCode) {
            $resonseHeader['code'] = strtoupper($returnCode) . '-' . $resoponseCode;
        } else {
            $resonseHeader['code'] = strtoupper($returnCode);
        }

        $resonseHeader['message']   = $resoponseMessage;
        $resonseHeader['ip']        = filter_input( INPUT_SERVER, 'REMOTE_ADDR');
        $resonseHeader['userAgent'] = filter_input( INPUT_SERVER, 'HTTP_USER_AGENT');

        $response["responseHeader"] = $resonseHeader;
        $response["responseBody"]   = $resoponseBody;

        //echo $_GET["callback"] . "(" . json_encode($response) . ")";
        echo "hoge(" . json_encode($response) .")";
        exit;
    }
}
