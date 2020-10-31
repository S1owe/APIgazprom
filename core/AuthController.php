<?php
require_once 'Auth.php';
require_once '../core/DB.php';
require_once '../core/User.php';


class AuthController extends Auth
{
    public static function checkAuth()
    {
        $db = DB::getInstance();
        if (isset(apache_request_headers()['Authorization'])) {
            $authToken = apache_request_headers()['Authorization'];
            $authToken = str_replace("Bearer ", "", $authToken);
        }
        if (isset($_COOKIE['token'])||isset($_GET['token'])) {
            try {
                $cooc=isset($_COOKIE['token'])?$_COOKIE['token']:$_GET['token'];
                $token = self::parseToken($cooc);
                $sql = sprintf("SELECT * FROM auth WHERE token = '%s' AND is_deleted = 0;",
                    $cooc);
                $bdToken = $db->getOneData($sql);
                if ($bdToken) {
                    return ['code' => 0, 'data' => $token, 'token' => $cooc];
                } else {
                    self::deleteTokenCookie();
                    return ['code' => "-2", 'error' => "INVALID_TOKEN"];
                }
            } catch (SignatureInvalidException $signatureInvalidException) {
                self::deleteTokenCookie();
                return ['code' => "-2", 'error' => "SIGNATURE_INVALID_TOKEN"];
            } catch (UnexpectedValueException $ex) {
                self::deleteTokenCookie();
                return ['code' => "-2", 'error' => "INVALID_TOKEN"];
            }
        } else if ($authToken) {
            try {
                $token = self::parseToken($authToken);
                $sql=sprintf("SELECT * FROM auth WHERE token = '%s' AND is_deleted = 0",
                    $authToken);
                $bdToken = $db->getOneData($sql);
                if ($bdToken) {
                    return ['code' => 0, 'data' => $token, 'token' => $_COOKIE['token']];
                } else {
                    self::deleteTokenCookie();
                    return ['code' => "-2", 'error' => "INVALID_TOKEN"];
                }
            } catch (SignatureInvalidException $signatureInvalidException) {
                self::deleteTokenCookie();
                return ['code' => "-2", 'error' => "SIGNATURE_INVALID_TOKEN"];
            } catch (ExpiredException $ex) {
                self::deleteTokenCookie();
                return ['code' => "-3", 'error' => "TIME_OUT_TOKEN"];
            } catch (UnexpectedValueException $ex) {
                self::deleteTokenCookie();
                return ['code' => "-2", 'error' => "INVALID_TOKEN"];
            }
        } else {
            return ['code' => "-1", "error" => "NO_TOKEN"];
        }
    }

    public function singIn($login, $password){
        $user = User::getUser($login, $password);
        if ($user)
            return $this->sign($user);
        else
            return ['code' => '1'];
    }

    public function signUp($fullName, $email, $password)
    {
        $res = User::addUser($fullName, $email, $password);
        if ($res['code'] == 0){
            $token =$this->createToken($res['id_user'], $fullName, $email);
            setcookie("token", $token, time() + 604800, '/');
            return ['code'=>'0', 'token'=>$token];
        }
        return $res;
    }

    public function deleteToken()
    {
        $db = DB::getInstance();
        $time = time();
        $token = isset($_COOKIE['token'])?$_COOKIE['token']:$_GET['token'];
        try {
            $db->query("START TRANSACTION;");
            $sql = sprintf("UPDATE auth SET is_deleted = 1, date = %d WHERE token = '%s'", $time, $token);
            $db->query($sql);
            $db->query("COMMIT;");
            Auth::deleteTokenCookie();
            return ['result' => '0'];
        } catch (Exception $ex) {
            $db->query("ROLLBACK;");
            return ['result' => '-1', 'error' => $ex->getTraceAsString()];
        }
    }
}
