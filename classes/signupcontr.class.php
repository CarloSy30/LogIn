<?php
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class signupcontr extends signupmodel{

    private $email;
    private $password;
    private $passwordRepeat;
    private $name;
    private $phoneNumber;

    public function __construct($email = null, $password = null, $passwordRepeat = null ,$name = null, $phoneNumber = null){
        $this->email = filter_var(trim($email, " "), FILTER_VALIDATE_EMAIL) ?: filter_var(trim($email, " "), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->passwordRepeat = filter_var($passwordRepeat, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->name =  filter_var(trim($name, " "), FILTER_SANITIZE_SPECIAL_CHARS);
        $this->phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function insertInfos(){
      if($this->isExisting($this->email) && $this->checkPassword($this->password, $this->passwordRepeat) &&
         $this->checkInput($this->name, $this->phoneNumber) && $this->checkEmptyFields($this->password, $this->passwordRepeat, $this->name, $this->phoneNumber, $this->email) && 
         $this->isEmailValid($this->email)){

        $hashed = password_hash($this->password, PASSWORD_DEFAULT);

        $this->insertUsersAccount($this->email, $hashed);
        $this->insertUsersInfo($this->getLastIndex(), $this->name, $this->phoneNumber);
        $this->sendOTP();
        $_SESSION['email'] = $this->email;
        return 'correct';
      }else{

        if(!$this->checkInput($this->name, $this->phoneNumber)){
            return 'invalid_input';
            exit();
        }

        if(!$this->checkEmptyFields($this->password, $this->passwordRepeat, $this->name, $this->phoneNumber, $this->email)){
            return 'empty';
            exit();
        }
        
        if(!$this->isEmailValid($this->email)){
            return 'invalid_email';
            exit();
        }

        if(!$this->isExisting($this->email)){
            return 'already_exist';
            exit();
        }


        if(!$this->checkPassword($this->password, $this->passwordRepeat)){
            return 'error_password';
            exit();
        }

        

      }
    }

   
    public function loginProcess(){
        $result = $this->verification($this->email, $this->password);
        if($result == "empty" || !$this->isPasswordEmpty($this->password)){
            return 'empty';
            exit();
        }else if(!$this->isEmailValid($this->email)){
            return 'invalid_email';
            exit();
        }else if($result == "wrong_email"){
            return 'wrong_email';
            exit();
        }else if($result == "wrong_password"){
            return 'wrong_password';
            exit();
        }else if($result == "not_activated"){
            return 'not_activated';
            exit();
        }

        return $result;

    }

    //FOR VERIFICATION OF USER ACCOUNT
    public function sendOTP(){
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
            $mail->Subject = "OTP Notification";
            //NAKA SESSION ANG OTP CODE DITO, PARA MAPUNTA SIYA SA otpForm.php for comparison of user input
            $_SESSION['otp'] = $this->otpCode();
            $templateBody = "
                    <h2> Hello this is yung OTP number: ". $_SESSION['otp'] ."</h2>";

            $mail->Body = $templateBody;
    
            $mail->send();
            return true;
        }catch(Exception $e){
            echo $mail->ErrorInfo;
            return false;
        }
    }
    
    // THIS IS VERIFICATION CODE
    private function otpCode(){
        $otp = null;
        for($x = 1; $x <= 4; $x++){
            $random = rand(0,9);
            $otp = $otp . $random;  
        }
        return $otp;
    }

    public function activateAccount($emailOTP, $insertOTP){
       
        if($this->checkOTP($emailOTP, $insertOTP)){
            $this->updateAccountStatus($this->email);
            return 'account_activated';
            exit();
        }else{
            return 'incorrect_OTP';
            exit();
        }
    }


}