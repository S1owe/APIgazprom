<?php


class User
{

    public static function getUser($login, $password){
        $db = DB::getInstance();
        try{
            $sql = sprintf("SELECT * FROM users WHERE email = '%s' AND pass = '%s'",
                $login, $password);
            return $db->getOneData($sql);
        }catch (Exception $exception){
            return ['code' => 0];
        }
    }

    public static function addUser($fullName, $email, $password){
        $db = DB::getInstance();
        try{
            $db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO users(full_name, email, pass) VALUES ('%s', '%s', '%s')",
                $fullName, $email, $password);
            $db->query($sql);
            $idUser = $db->getLastInserted();
            $db->query("COMMIT;");
            return ['code' => 0, 'id_user' => $idUser];
        }catch (Exception $exception){
            $db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(), 'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public static function isUser($email){
        $db = DB::getInstance();
        $sql = sprintf("SELECT id, email, pass FROM users WHERE email LIKE '%s' AND is_deleted=0 limit 1",$email);
        return $db->getOneData($sql);
    }

}