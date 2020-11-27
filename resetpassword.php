<?php
 include('Connect.php');
 header('Content-Type: application/json');
 class restpassword
 {
 private $db;
 private $connection;
 function __construct()
 {
 //constructor call
 $this->db = new Connection();
 $this->connection=$this->db->get_connection();
 }
 public function resetting_password($resetpass,$mail)
 {
 // does user already exist or not
 $query = "SELECT * FROM users WHERE email='$mail'";
 $result=mysqli_query($this->connection,$query);
 if(mysqli_num_rows($result)>0){
    
     //database code for inserting otp
        $querys="UPDATE users SET password='$resetpass' WHERE email='$mail'";
          $is_inserted=mysqli_query($this->connection,$querys);
          if($is_inserted == 1){
        $json['status']=200;
             $json['message']='Password changed';
            //   $json['p']=$otp;
          }else {
        $json['status']=401;
             $json['message']='Something wrong';
          }
          echo json_encode($json);
          mysqli_close($this->connection);
     

 }  else {
     $json['status']=400;
$json['message']=' Sorry '.$mail.' is does not exist.';
   echo json_encode($json);
   mysqli_close($this->connection);
     

 }
 } 
    }

 $password_rest =new restpassword();
 if(isset($_POST['resetpass'],$_POST['email']))
 {
     $mail=$_POST['email'];
   $resetpass=$_POST['resetpass'];
 if (!empty($resetpass) && !empty($mail) ) {
     $password_rest->resetting_password($resetpass,$mail);
   }else {
$json['status']=100;
     $json['message']='You must fill all the fields';
     echo json_encode($json);
   }
 }


?>