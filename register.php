<?php
 include('Connect.php');
 header('Content-Type: application/json');
 class Register
 {
 private $db;
 private $connection;
 function __construct()
 {
 //constructor call
 $this->db = new Connection();
 $this->connection=$this->db->get_connection();
 }
 public function does_user_exist($firstName,$lastName,$employeeId,$employee,$state,$club,$mail,$encrypted_password,$avatarName)
 {
 // does user already exist or not
 $query = "SELECT * FROM users WHERE email='$mail'";
 $result=mysqli_query($this->connection,$query);
 if(mysqli_num_rows($result)>0){
$json['status']=400;
$json['message']=' Sorry '.$mail.' is already exist.';
   echo json_encode($json);
   mysqli_close($this->connection);
 }else
{
   $query="insert into users(firstName,lastName,employeeId,employee,state,club,email,password,avatarName) values('$firstName','$lastName','$employeeId','$employee','$state','$club','$mail','$encrypted_password','$avatarName')";


   $is_inserted=mysqli_query($this->connection,$query);

   if($is_inserted == 1){
$json['status']=200;
     $json['message']='Account created';
   }else {
$json['status']=401;
     $json['message']='Something wrong';
   }
   echo json_encode($json);
   mysqli_close($this->connection);
 }
 } 
 }
 $register=new Register();
 // echo json_encode($_POST);
 if(isset($_POST['firstName'],$_POST['lastName'],$_POST['employeeId'],$_POST['employee'],$_POST['state'],$_POST['club'],$_POST['email'],$_POST['password'],$_POST['avatarName']))
 {
   $firstName=$_POST['firstName'];
   $lastName=$_POST['lastName'];
   $employeeId=$_POST['employeeId'];
   $employee=$_POST['employee'];
   $state=$_POST['state'];
   $club= $_POST['club'];
   $mail=$_POST['email'];
   $pass=$_POST['password'];
   $avatarName=$_POST['avatarName'];
  
 if (!empty($firstName) && !empty($lastName) && !empty($employeeId) && !empty($employee)&& !empty($state)&& !empty($club)&& !empty($mail)   && !empty($pass)&& !empty($avatarName)) {
     $encrypted_password=md5($pass);
     $register->does_user_exist($firstName,$lastName,$employeeId,$employee,$state,$club,$mail,$encrypted_password,$avatarName);
   }else {
$json['status']=100;
     $json['message']='You must fill all the fields';
     echo json_encode($json);
   }
 }

?>