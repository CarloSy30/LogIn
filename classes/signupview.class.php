<?php

class signupview extends signupmodel{

    public function showAlert($alert){

        // $typeAlerts = array("correct" => "Success! Signup completed.",
        //                     "already_exist" => "The Email is already exist.",
        //                     "error_password" => "Password Error.",
        //                     "email_sent" => "Email reset password sent.",
        //                     "password_updated" => "Password updated.",
        //                     "expired_tokens" => "Expired tokens.",
        //                     "wrong_password" => "Incorrect password.",
        //                     "wrong_email" => "Wrong email.",
        //                     "invalid_email" => "Invalid email.",
        //                     "invalid_input" => "Invalid input.",
        //                     "invalid_tokens" => "Invalid token.",
        //                     "empty" => "Please complete the form.",
        //                     "error" => "Something error in the code."
        //                     );

        // foreach($typeAlerts as $key => $value){
        //     if($alert == $key){

        //         if($alert == "correct" || $alert == "email_sent" || $alert == "password_updated"){
        //             return '<div class="alert alert-success alert-dismissible fade show">
        //             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        //             '.$value.'</div>';
        //             exit();
        //         }
        //         return '<div class="alert alert-danger alert-dismissible fade show">
        //         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        //         '.$value.'</div>';
        //         exit();
        //     }else{
        //         echo "the condition doesn't match in any alert.";
        //         break;
        //     }
        // }

        switch($alert){
            case 'correct':
                return '<div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Success!</strong> Signup completed.  </div>';
                break;
            case 'already_exist':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        The email is already exist.  </div>';
                break;
            case 'error_password':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Password Error.  </div>';
                break;
            case 'email_sent':
                return '<div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Email reset password has been sent.  </div>';
                break;
            case 'password_updated':
                return '<div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Password!</strong> updated.  </div>';
                break;
            case 'expired_tokens':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Expired!</strong> Token.  </div>';
                break;
            case 'wrong_password':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        Incorrect Password.  </div>';
                break;
            case 'wrong_email':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Wrong!</strong> email.  </div>';
                break;
            case 'invalid_email':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Invalid!</strong> email.  </div>';
                break;
            case 'invalid_input':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Invalid!</strong> input.  </div>';
                break;
            case 'invalid_tokens':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Invalid!</strong> Token.  </div>';
                break;
            case 'empty':
                return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Empty!</strong> Please complete the fields.  </div>';
                break;
            default:
            return '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    ALERT ERROR ERROR ERROR  </div>';
            break;
            
        }
       
    }

}
