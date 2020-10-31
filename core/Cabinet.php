<?php


class Cabinet
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addTeam($userId, $teamName){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO teams(id_owner, `name`, date_create) VALUES (%d, '%s', %d)",
                            $userId, $teamName, time());
            $this->db->query($sql);
            $id = $this->db->getLastInserted();
            $sql = sprintf("INSERT INTO user_teams(id_user, id_team) VALUES (%d, %d)", $userId, $id);
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' =>0, "id_team" => $id];
        }catch (Exception $exception){

        }
    }

    public function getAllUserTeams($userId){
        $sql = sprintf("SELECT t.id, t.name, u.full_name as owner, from_unixtime(t.date_create, %s) as date_create 
                        FROM teams t RIGHT JOIN user_teams ut ON ut.id_user=%d AND ut.id_team=t.id
                        RIGHT JOIN users u ON u.id=t.id_owner WHERE t.is_deleted=0", "'%d.%m.%Y'", $userId);
        $teams = $this->db->getAllData($sql);
        foreach ($teams as &$team){
            $sql = sprintf("SELECT u.id, u.full_name FROM users u
                    RIGHT JOIN user_teams ut ON ut.id_team=%d AND ut.is_deleted=0
                    WHERE u.is_deleted=0", $team['id']);
            $team['users'] = $this->db->getAllData($sql);
        }
        return $teams;
    }

    public function getOneTeam($teamId){
        $sql = sprintf("SELECT t.id, t.name, u.full_name as owner FROM teams t 
                        LEFT JOIN users u ON u.id=t.id_owner
                        WHERE t.id=%d", $teamId);
        $team = $this->db->getOneData($sql);

        $sql = sprintf("SELECT a.id, a.name, from_unixtime(a.date, %s) as date_create
                        FROM apps a WHERE a.id_team=%d and a.is_deleted=0", "'%d.%m.%Y'", $teamId);
        $team['apps'] =$this->db->getAllData($sql);
        return $team;
    }

    public function deleteTeam($teamId){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("UPDATE teams SET is_deleted=1 WHERE id=%d", $teamId);
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' => 0];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function inviteUser($teamId,$userId){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO user_teams(id_team,id_user) VALUES (%d, %d)", $teamId, $userId);
            $this->db->query($sql);
            $this->db->query("COMMIT;");
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function addApp($teamId, $appName){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("INSERT INTO apps(id_team, `name`, client_id, secret_key, `date`) 
                        VALUES (%d, '%s', '%s', '%s', %d)", $teamId, $appName, md5(microtime() . 'salt' . time()),
                        md5(microtime() . 'salt' . time()), time());
            $this->db->query($sql);
            $id = $this->db->getLastInserted();
            $this->db->query("COMMIT;");
            return ['error' => 0, 'id_app' => $id];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function getAllApps($userId, $teamId){
        $sql = sprintf("SELECT a.id, a.name, from_unixtime(a.date, %s) as date_create, u.full_name as owner, t.name as team FROM apps a
                        LEFT JOIN teams t ON t.id=a.id_team LEFT  JOIN users u ON u.id=t.id_owner
                        RIGHT JOIN user_teams ut ON ut.id_user=%d AND ut.id_team=a.id_team
                        WHERE a.is_deleted=0 AND a.id_team=%d", "'%d.%m.%Y'", $userId, $teamId);
        return $this->db->getAllData($sql);
    }

    public function getOneApp($appId){
        $sql = sprintf("SELECT a.name, t.name as team, u.full_name as owner, a.client_id, 
                        a.secret_key, from_unixtime(a.date, %s) as date_create FROM apps a
                        LEFT JOIN teams t ON t.id=a.id_team
                        LEFT JOIN users u ON u.id=t.id_owner
                        WHERE a.id=%d", "'%d.%m.%Y'", $appId);

        $app = $this->db->getOneData($sql);
        $sql = sprintf("SELECT a.title, a.description, if(EXISTS(SELECT aa.id FROM app_api aa 
                        where aa.id_api=a.id AND aa.id_app=%d AND aa.is_deleted=0), 1, 0) is_enabled, 
                        a.is_premium FROM api a WHERE a.is_deleted=0", $appId);
        $app['api'] = $this->db->getAllData($sql);
        return $app;
    }

    public function enableApi($appId, $apiId, $type){
        try{
            $sql = sprintf("SELECT id FROM app_api aa WHERE aa.id_app=%d AND aa.id_api=%", $appId, $apiId);
            $id = $this->db->getOneData($sql)['id'];
            $this->db->query("START TRANSACTION;");
            if($id!=null)
                $sql = sprintf("INSERT INTO app_api(id_app, id_api, is_deleted)", $appId, $apiId, $type);
            else
                $sql = sprintf("UPDATE app_api SET is_deleted=%d WHERE id=%d", $type, $id);
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' => 0];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function deleteApp($appId){
        try{
            $this->db->query("START TRANSACTION;");
            $sql = sprintf("UPDATE apps SET is_deleted=1 WHERE id=%d", $appId);
            $this->db->query($sql);
            $this->db->query("COMMIT;");
            return ['error' => 0];
        }catch (Exception $exception){
            $this->db->query("ROLLBACK;");
            return ['code' => '-1', 'error' => $exception->getTraceAsString(),
                'notify_msg'=>'Произошла ошибка при выполнении операции!'];
        }
    }

    public function getRequests($idApp, $idApi, $type){
        $sql = sprintf("SELECT COUNT(ar.id) `count`, from_unixtime(ar.`date`, %s) as date FROM api_requests ar 
                        RIGHT JOIN app_api aa ON aa.id_app =%d AND aa.id_api=%d 
                        WHERE %s ar.id_app_api=aa.id GROUP BY ar.`date` 
                        ORDER by ar.date ASC", "'%d %b'", $idApp, $idApi, $type==0?"ar.`type`=0 AND ":"");
        $result = $this->db->getAllData($sql);
        $data = ['count' =>[],
                 'dates' =>[]];
        foreach ($result as $item){
            array_push($data['count'], $item['count']);
            array_push($data['dates'], $item['date']);
        }
        return $data;
    }
}