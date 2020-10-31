<?php
require_once '../core/AuthController.php';
require_once '../core/ApiPage.php';
require_once '../core/Cabinet.php';
require_once '../core/Mail.php';
require_once '../core/Messages.php';

class BankApi
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function checkAuth()
    {
        $user_data = AuthController::checkAuth();
        if ($user_data['code'] == 0) {
            return ['code' => '0', 'username' => $user_data['data']->full_name/*, 'token' => $_COOKIE['token']*/];
        } else {
            return $user_data;
        }
    }

    public function signIn($args)
    {
        $login = $args['login'];
        $password = $args['password'];
        $auth = new AuthController();
        $token = $auth->singIn($login, $password);
        switch ($token['code']) {
            case '1':
                return ['result' => '-6', 'error' => 'BAD LOGIN OR PASS','notify_msg'=>'Неверный логин или пароль'];
                break;
            case '0':
                return ['result' => '0', 'status' => 'ok', 'username' => $token['full_name'], 'token' => $token['token']];
                break;
            default:
                return $token;
        }
    }

    public function signUp($args)
    {
        $fullName = $args['full_name'];
        $email = $args['email'];
        $password = $args['password'];
        $auth = new AuthController();
        $res = $auth->signUp($fullName, $email, $password);
        return $res;
    }

    public function getAllApi(){
        $api = new ApiPage();
        return $api->getAllApi();
    }

    public function logout()
    {
        $auth = new AuthController();
        $auth->deleteToken();
        return ['code' => '0'];
    }

    public function addTeam($args){
        $teamName = $args['team_name'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->addTeam($user_data['data']->id, $teamName);
        return $user_data;
    }

    public function deleteTeam($args){
        $teamId = $args['id_team'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->deleteTeam($teamId);
        return $user_data;
    }

    public function addApp($args){
        $teamId = $args['id_team'];
        $appName = $args['app_name'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->addApp($teamId, $appName);
        return $user_data;
    }

    public function deleteApp($args){
        $appId = $args['id_app'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->deleteApp($appId);

        return $user_data;
    }

    public function getApp($args){
        $appId = $args['id_app'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->getOneApp($appId);

        return $user_data;
    }

    public function enableApi($args){
        $appId = $args['id_app'];
        $apiId = $args['id_api'];
        $type = $args['type'];
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->enableApi($appId, $apiId, $type);

        return $user_data;
    }

    public function getAllUserTeams($args){
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();

        if ($user_data['code'] == 0)
            return $cabinet->getAllUserTeams($user_data['data']->id);

        return $user_data;
    }

    public function getOneTeam($args){
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();
        $teamId = $args['id_team'];

        if ($user_data['code'] == 0)
            return $cabinet->getOneTeam($teamId);

        return $user_data;
    }

    public function getAllApps($args){
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();
        $teamId = $args['id_team'];

        if ($user_data['code'] == 0)
            return $cabinet->getAllApps($user_data['data']->id, $teamId);

        return $user_data;
    }

    public function getStatistic($args){
        $user_data = AuthController::checkAuth();
        $cabinet = new Cabinet();
        $appId = $args['id_app'];
        $apiId = $args['id_api'];
        $type = $args['id_type'];

        if ($user_data['code'] == 0)
            return $cabinet->getRequests($appId, $apiId, $type);

        return $user_data;
    }

    public function sandbox($args){
        $api = new ApiPage();
        return $api->getSandbox(json_decode($args['payload'], true));
    }

    public function getAllProducts(){
        $api = new ApiPage();
        return $api->getProducts();
    }

    public function getDocumentation($args){
        $api = new ApiPage();
        $apiId = $args['id_api'];
        return $api->getApiDocumentation($apiId);
    }

    public function test(){
        $mail = new Mail();
        $mail->sendMail('ollykopylova@gmail.com',1);
    }

    public function active($args){
        $auth = new AuthController();
        $userData = AuthController::parseToken($args['token']);
        $user = User::isUser($userData['data']->email);
        if($user['id']!=null){
            $auth->singIn($userData['data']->email, $user['pass']);
        } else{
            $password = md5(microtime() . 'salt' . time());
            $auth->signUp('No name', $userData['data']->email, $password);
            $mail = new Mail();
            $mail->sendPassword($userData['data']->email, $password);
            $cabinet = new Cabinet();
            $user_data = AuthController::checkAuth();

        }
    }

    public function getDialogTypes(){
        $message = new Messages();
        return $message->getConfTypes();
    }

    public function getAllDialogs(){
        $message = new Messages();
        $user_data = AuthController::checkAuth();

        if ($user_data['code'] == 0)
            return $message->getDialogs($user_data['data']->id);

        return $user_data;
    }

    public function addDialog($args){
        $message = new Messages();
        $user_data = AuthController::checkAuth();
        $type = $args['id_type'];

        if ($user_data['code'] == 0)
            return $message->createDialog($user_data['data']->id, $type);

        return $user_data;
    }

    public function sendMessage($args){
        $message = new Messages();
        $user_data = AuthController::checkAuth();
        $convId = $args['id_conv'];
        $mess = $args['message'];

        if ($user_data['code'] == 0)
            return $message->sendMessage($convId, $user_data['data'], $mess);

        return $user_data;
    }
}
