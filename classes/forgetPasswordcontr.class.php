<?php
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class forgotPasswordcontr extends signupmodel{
    
    private $email;
    private $newPassword;
    private $confirmPassword;
    private $tokens;

    public function __construct($email, $newPassword = null, $confirmPassword = null, $tokens = null){
        $this->email = filter_var(trim($email, " "), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->newPassword = filter_var($newPassword, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->tokens = filter_var($tokens, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function passwordResetLink(){

        if(!$this->isExisting($this->email) && $this->isEmailValid($this->email)){
           
            
            if($this->updateTokens($this->email, time()) && $this->sendResetPassword()){
                $tokenInfo = $this->getTokens($this->email);
                // session_start(); may nakalagay na kasing session_start() sa forgotPassword.php sa taas kaya no need na to.
                $_SESSION['forgotEmail'] = $this->email;
                $_SESSION['passwordTokens'] = $tokenInfo['tokens'];

            }else{
                return 'error';
                exit();
            }

            return 'email_sent';
            exit();
        }
        return 'wrong_email';
  
    }

    private function sendResetPassword(){
        include_once 'oneTimePassword.php';
        $mail = new PHPMailer(true);
        try{
            // $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth= true;
            $mail->Username = 'dancarlosyyyyy30@gmail.com';
            $mail->Password = $emailPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->From = $this->email;
            $mail->FromName = "FLAT-OS";
            $mail->addAddress($this->email);
            $mail->isHTML(true);
            $mail->Subject = "Reset Password Notification";
          
            $templateBody = "
                    <h2> Hello </h2>
                    <br/><br/>
                    <a href='http://localhost/login/passwordReset.php'> click me </a>
            ";

            $mail->Body = $templateBody;
    
            $mail->send();
            return true;
        }catch(Exception $e){
            echo $mail->ErrorInfo;
            return false;
        }
    }
        
    public function passwordReset(){
        $tokenInfo = $this->getTokens($this->email);

        if($this->isExisting($this->email) || !$this->isEmailValid($this->email)){
            return 'invalid_email';
            exit();
        }

        if(!$this->isPasswordEmpty($this->newPassword) || !$this->isPasswordEmpty($this->confirmPassword)){
            return 'empty';
            exit();
        }        

        if($tokenInfo['tokens'] !== $this->tokens){
            return 'invalid_tokens';
            exit();
        }

        if(time() - $tokenInfo['expiry_tokens'] >= 40){
            return 'expired_tokens';
            exit();
        }

        if(!$this->checkPassword($this->newPassword, $this->confirmPassword)){
            return 'error_password';
            exit();
        }

        $hashed = password_hash($this->newPassword, PASSWORD_DEFAULT);

        $this->updatePassword($hashed, $this->email);
        $this->updateTokens($this->email);
        return 'password_updated';
    }

}