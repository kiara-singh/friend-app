<!--//object to check data-->
<?php
//connection to database
class Connect extends PDO{
    
    public function __construct(){
        parent::__construct("mysql:host=localhost;dbname=app", 'root', '',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}

class Controller {
//    generate char
//    function generateCode{
//        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
//        $password = substr( str_shuffle( $chars ), 0, 8 );
//// Encrypt password
//        $password = password_hash($password, PASSWORD_ARGON2I);
////        $code = "";
////        $clean = strlen($chars)-1;
////        while(strlen($code)<$length){
////           $code = $chars[mt_rand(0, $clean)];
//        }
//        return $code;
    
//    insert data 
    function insertData($data){
        $db = new Connect;
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $password_secure=password_hash($password, PASSWORD_ARGON2I);
      
        $check_user = $db -> prepare("SELECT * FROM users WHERE username=:email");
         $check_user->execute([
            ':email' => $data["email"]   
        ]);  
        $fetch = $check_user->fetch(PDO::FETCH_ASSOC);
        if (is_array($fetch))  {
            header("Location: welcome.php");
        }else{
             $insertNewUser = $db -> prepare("INSERT INTO users (id, access,username,password) VALUES (:id, :access, :email,:password)");
            $insertNewUser -> execute([
                ':id'   => " ",
                ':access'   => "1",
                ':email'   => $data["email"],
                ':password' => $password_secure,
            ]);
            $_SESSION["role"] = "1";
                
        }

    }
}
       
//        $checkUser -> execute(array(
////            'email'=> $data['email']
//        ));
//        $info = $checkUser -> fetch(PDO::FETCH_ASSOC);
//        if($info["id"]??=false){
      
//            if($insertNewUser){
//                header('Location: welcome.php');
//                exit();
//            }else{
//                return "Error inserting User!";
//            }
//        }else{
//            header('Location: welcome.php');
//            exit();
        
    
    
    

?>