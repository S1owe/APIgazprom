<?php


class Messages
{
    private $db;
    private $message = "Здравствуйте, можете задавать любые вопросы, возникающие по теме API.";

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function createDialog($userId, $type){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO conversation(id_type, time) VALUES (%d, %d)", $type, time());
            $this->db->query($sql);
            $id = $this->db->getLastInserted();
            $sql = sprintf("INSERT INTO conversation_user(id_conv, id_user) VALUES (%d, %d)", $id, $userId);
            $this->db->query($sql);
            $user = $this->db->getOneData("SELECT u.id FROM users u WHERE u.role=1 limit 1")['id'];
            $sql = sprintf("INSERT INTO conversation_user(id_conv, id_user) VALUES (%d, %d)", $id, $user);
            $this->db->query($sql);
            $sql = sprintf("INSERT INTO messages(id_conv, id_user, text, time) VALUES (%d, %d, '%s', %d)",
                            $id, $userId, $this->message, time());
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' => 0];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function getDialogs($userId){
        $sql = sprintf("SELECT ct.title as type, u.full_name as operator,  from_unixtime(c.time, %s) time FROM conversation c
                        LEFT JOIN conversation_type ct ON ct.id=c.id_type
                        LEFt JOIN users u ON u.id<>cu.id_user
                        WHERE EXISTS(SELECT cu.id FROM conversation_user cu WHERE cu.id_user=%d) AND c.is_deleted=0", "'%d %b'", $userId);
        return $this->db->getAllData($sql);
    }

    public function getOneDialog($id){
        $sql = sprintf("SELECT u.full_name, m.text, from_unixtime(m.time, '%d.%m.%Y') as date FROM messages m 
                        LEFT JOIN users u ON u.id=m.id_user
                        WHERE m.id_conv=%d ORDER BY time ASC");
    }

    public function getConfTypes(){
        $sql = "SELECT id, title FROM conversation_type";
        return $this->db->getAllData($sql);
    }

    public function sendMessage($convId, $userId, $message){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO messages(id_conv, id_user, text, time) VALUES (%d, %d, '%s', %d)",
                            $convId, $userId, $message, time());
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' => 0];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

}
