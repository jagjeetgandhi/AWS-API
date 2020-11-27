<?php
include('Connect.php');
header('Content-Type: application/json');

class User
{
private $db;
private $connection;
function __construct()
{
$this->db = new Connection();
$this->connection=$this->db->get_connection();
}
public function does_user_exist($employeeId,$pass){
    $query = "SELECT * FROM users WHERE avatarName='$employeeId' AND password='$pass'";
    $result=mysqli_query($this->connection,$query);
    if(mysqli_num_rows($result)>0){
    $row= mysqli_fetch_array($result);
    $data = array(); 
    array_push($data,array( 
    "firstName"=>$row['firstName'],
    "lastName"=>$row['lastName'],
    "employeeId"=>$row['employeeId'],
    "employee" =>$row['employee'],
    "state"=>$row['state'],
    "club"=>$row['club'],
    "email"=>$row['email'],
    "password"=>$row['password'],
    "avatarName"=>$row['avatarName'],
     ) );
    
    $json['status']=200;
    $json['message']='Login Successful';
    $json['detail']=$data;
    
    echo json_encode($json);
    
    mysqli_close($this->connection);
    }else { 
    $json['status']=400;
    $json['message']='Wrong email or password';
    echo json_encode($json);
    mysqli_close($this->connection);
    }
    }
    }
    
    $user = new User();
    if(isset($_POST['avatarName'],$_POST['password']))
    {
    $employeeId=$_POST['avatarName'];
    $pass=$_POST['password'];
    if (!empty($employeeId) && !empty($pass)) {
    $encrypted_password=md5($pass);
    $user->does_user_exist($employeeId,$encrypted_password);
    }else {
    $json['status']=100;
    $json['message']='You must fill both fields';
    echo json_encode($json);
    }
    }
?>