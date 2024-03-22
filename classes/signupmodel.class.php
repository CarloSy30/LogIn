<?php

class signupmodel extends Dbh{
    
    protected function insertUsersAccount($email, $password){
        $sql = "INSERT INTO accounts (user_name, password) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);

        $stmt->execute();
        $stmt = null;
    }

    protected function insertUsersInfo($accountId, $name, $phoneNumber){
        $sql = "INSERT INTO user_info (account_id ,name, phone_number) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $accountId, PDO::PARAM_INT);
        $stmt->bindParam(2, $name, PDO::PARAM_STR);
        $stmt->bindParam(3, $phoneNumber, PDO::PARAM_STR);

        $stmt->execute();
        $stmt = null;
    }

    protected function isExisting($email){
        $sql = "SELECT user_name FROM accounts WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);

        $stmt->execute();

        if(!$stmt->rowCount() > 0){
            $stmt = null;
            return true;
            exit();
        }
        
        $stmt = null;
        return false;
    }

    protected function getLastIndex(){
        $sql = "SELECT account_id FROM accounts ORDER BY account_id DESC LIMIT 1";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetch();

        $stmt = null;
        return $result['account_id'];
    }

    protected function verification($email, $password){
        $sql = "SELECT * FROM accounts WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);

        $stmt->execute();
        $data = $stmt->fetch();
        
        if(empty($email)){
            $stmt = null;
            return 'empty';
            exit();
        }

        if($stmt->rowCount() == 0){
            
            $stmt = null;
            return 'wrong_email';
            exit();
          
        }

        $checkPassword = password_verify($password, $data['password']);
        if(!$checkPassword){
            $stmt = null;
            return 'wrong_password';
            exit();
        }

        $stmt = null;
        // session_start();
        /*Hindi na kailangan mag lagay ng session_start() dito dahil may session_start() na sa require_once 'config.php' 
        sa pinakataas ng index.php file. */
        $_SESSION['account_id'] = $data['account_id'];
        return 'correct';
             
    }
   
    //QUERY FORGOT PASSWORD
    protected function updateTokens($email, $expiryToken = null){
        $tokens = hash("sha256", rand());
        $sql = "UPDATE accounts SET tokens = ?,expiry_tokens = ? WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $tokens, PDO::PARAM_STR);
        $stmt->bindParam(2, $expiryToken, PDO::PARAM_INT);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);

        $stmt->execute();
        $stmt = null;
        return true;
    }

    protected function getTokens($email){
        $sql = "SELECT tokens, expiry_tokens FROM accounts WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
    
        $stmt->execute();
        $data = $stmt->fetch();

        $stmt = null;
        return $data;
    }

    protected function updatePassword($password, $email){
        $sql = "UPDATE accounts SET password = ? WHERE user_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);

        $stmt->execute();
        $stmt = null;
    }



    //LOGIC HERE (LOG IN AND SIGN UP)
    protected function checkEmptyFields($password, $passwordRepeat, $name, $phoneNumber, $email){
        
        if(!empty($password) && !empty($passwordRepeat) && !empty($name) && !empty($phoneNumber) && !empty($email)){      
            return true;
        }else{    
            return false;
        }
    }

    protected function isEmailValid($email){

        $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);

        if($isEmailValid){
            return true;
        }else{
            return false;
        }

    }

    protected function isPasswordEmpty($password){
        if(!empty($password)){
            return true;
        }else{
            return false;
        }
    }

    protected function checkInput($name, $phoneNumber){
        $hasNumbers = "/[0-9]/";
        $hasLetters = "/[a-z]|\W/i";
        if(preg_match($hasNumbers, $name) || preg_match($hasLetters, $phoneNumber)){
            return false;
        }else{
            return true;
        }
    }

    protected function checkPassword($password, $passwordRepeat){
        $hasLetters = "/[a-zA-z]/i";
        $hasNumbers = "/[0-9]/";

        if(preg_match($hasLetters, $password) && preg_match($hasNumbers, $password) && strlen($password) >= 10){
            if($password == $passwordRepeat){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    //LOGIC HERE (VERIFYING ACCOUNT THRU EMAIL)
  
}
