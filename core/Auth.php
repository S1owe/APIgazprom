<?php
require_once 'JWT/JWT.php';
class Auth
{
    private $db;

    private $privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDMwm2a9RfmK/8gN5lcEW2c0clN4ns/JKj2VsmzKYJAzejgJRZa
1Gf4+Aj6WP5X+4z2cSLZXz3XjBY9OBGN4GZsNO2lWPhgusZOVhNv0Mr4VWDMFisB
lUNRT7ok5AhZrK+zIbPMRAcodfk2WhiskUosuSgD/bJzl2YmJbEvJ6LeyQIDAQAB
AoGAaMF8A9AqtvaBYwEu87xy4M0veSpKtaZSzxzdukydN/xgjPRMeJG809JJ/ZK0
JV0r5BVDqAQjBnjEE/Pwfy50FzMh5ForqIz9MwJ2N06s2KW5zTJWtcGMf6Z6DlIj
DwLng8Y2VbCO3uAaYfrNtwLKjQ3EfOd1q3LOAqFB9ksTFXUCQQD2b9RvUVWbW8Vz
EzzWRCFuR6mv4bI+5Z2GQoYC8CdarF/BepfgDVJIYq1kHW9B10O2Td/4TqBnisi6
VhEkGQDHAkEA1LSQcsm1lLHHUnr3jBUoIv4lBHE17O4LO5+EF/VBwFhQuoI2h3mp
WiUdHsFvWPNMBZDr/KK5aiH6uZbQAUCz7wJAYixSuLXyIJ4CnsE/LyydFM2/r619
0MiwZFgEAw+g3eJlkzI/ZqZn7SZCZOvE8rnK48lKPCU2iYkkRfcbhQHg6QJAMs87
HiBu3qkk6t/y2CSJpOo+n3QHpKQsTL7LCAoO/cpa5mKKcgwu1xi8fwdH+OCNTVsT
9BJO5jpdsQ2EfHgfQwJBAO6+5wseLCQdDX7HPxfOwJWrGaLBDOWqiTrgcHg8Coj/
4gfuCDD5cM+R1iQiLYoiZXorvZaeafEo8hPU4O/s55Y=
-----END RSA PRIVATE KEY-----
EOD;

    private static $public_key = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMwm2a9RfmK/8gN5lcEW2c0clN
4ns/JKj2VsmzKYJAzejgJRZa1Gf4+Aj6WP5X+4z2cSLZXz3XjBY9OBGN4GZsNO2l
WPhgusZOVhNv0Mr4VWDMFisBlUNRT7ok5AhZrK+zIbPMRAcodfk2WhiskUosuSgD
/bJzl2YmJbEvJ6LeyQIDAQAB
-----END PUBLIC KEY-----
EOD;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }


    public static function parseToken($token){
        $decoded = \Firebase\JWT\JWT::decode($token, self::$public_key, array('RS512'));
        return $decoded;
    }

    protected function sign($user){
        $token = $this->createToken($user['id'], $user['full_name'], $user['email']);
        setcookie("token", $token, time() + 604800, '/');

        if (isset($token['result']))
            return $token;

        return ['code' => '0', 'token' => $token, 'full_name' => $user['full_name']];
    }

    public function createToken($id, $fullName, $email)
    {

        $time = time();
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];

        $user_data = [
            "iss" => "http://gasbank.creativityprojectcenter.ru/",
            "aud" => "http://gasbank.creativityprojectcenter.ru/",
            "user_agent" => $userAgent,
            "ip" => $ip,
            "login" => $email,
            "id" => $id,
            "full_name" => $fullName,
            "email" => $email
        ];
        $jwt = \Firebase\JWT\JWT::encode($user_data, $this->privateKey, 'RS512');
        try {
            $sql = sprintf("SELECT * FROM auth WHERE token = '?s' AND is_deleted = 0", $jwt);
            $is_token = $this->db->getOneData($sql);
            if ($is_token) {
                return $is_token["token"];
            } else {
                $this->db->query("START TRANSACTION;");
                $sql = sprintf("INSERT INTO auth (id_user, token, ua, `date`, ip) VALUE (%d,'%s','%s',%d,'%s');",
                    $id, $jwt, $userAgent, $time, $ip);
                $this->db->query($sql);
                $this->db->query("COMMIT;");
            }
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return ['result' => '-1', 'error' => $ex->getMessage()];
        }

        return $jwt;
    }

    public static function deleteTokenCookie(){
        setcookie("token", '', time()-1000);
        setcookie("token", '', time()-1000, '/');
    }
}
