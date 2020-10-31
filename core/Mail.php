<?php
require_once 'PHPMailer.php';
require_once 'Auth.php';

class Mail
{

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
       // $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = 'ssl://smtp.google.ru';
        $this->mail->Username = 'olenkakopylova@gmail.com';
        $this->mail->Password = 'Vasw9m2le8olly';
        $this->mail->Port = 465;
    }
    public function sendMail($to, $teamId)
    {
        try {
            $auth = new Auth();
            $this->mail->setFrom("olenkakopylova@gmail.com", "Газпромбанк");
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = "Добро пожаловать в команду $teamId";
            $this->mail->Body = "Здравствуйте!
            Вас пригласили в команду $teamId.
            Для активации аккаунта перейдите по ссылке:
            http://gasbank.creativityprojectcenter.ru/api/api.php?type=active&id_team=$teamId&token=".$auth->createToken(0,'No name', $to);

            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function sendPassword($to,$password){
        try {
            $this->mail->setFrom("olenkakopylova@gmail.com", "Газпромбанк");
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Добро пожаловать!";
            $this->mail->Body = "Ваш новый пароль:$password";
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}