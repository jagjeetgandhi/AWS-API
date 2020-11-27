 <?php
 include('Connect.php');
 header('Content-Type: application/json');

 class otp
 {
 private $db;
 private $connection;
 function __construct()
 {
 //constructor call
 $this->db = new Connection();
 $this->connection=$this->db->get_connection();
 }
public function generateNumericOTP($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "1357902468"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 
  
// Main program 

 public function request_otp($mail,$otp)
 {
 // does user already exist or not
 $query = "SELECT * FROM users WHERE email='$mail'";
 $result=mysqli_query($this->connection,$query);
 if(mysqli_num_rows($result)>0){
    
     //database code for inserting otp
        $querys="UPDATE users SET otp='$otp' WHERE email='$mail'";
          $is_inserted=mysqli_query($this->connection,$querys);
          if($is_inserted == 1){
              
              
              $msg = "Hello $mail\n Your Otp : $otp for login";

          // use wordwrap() if lines are longer than 70 characters
          $msg = wordwrap($msg,70);

          // send email
          mail($mail,"My subject",$msg);
        
        $json['status']=200;
             $json['message']='OTP sent ';
              $json['otp']=$otp;
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
 
 public function does_otp_verified($otp){
    $query = "SELECT * FROM users WHERE otp='".$otp."'";
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
    $json['message']='otp verified';
    $json['detail']=$data;
    
    echo json_encode($json);
    
    mysqli_close($this->connection);
    }else { 
    $json['status']=400;
    $json['message']='Wrong otp';
    echo json_encode($json);
    mysqli_close($this->connection);
    }
    }
    }
 
 
 
 
 
 
 
 $otpobject =new otp();
 if(isset($_POST['email']))
 {
   $mail=$_POST['email'];
 if (!empty($mail)) {
    // $encrypted_password=$pass;
     $n = 6; 
     $otp = $otpobject->generateNumericOTP($n);
     $otpobject->request_otp($mail,$otp);
   }else {
$json['status']=100;
     $json['message']='You must fill all the fields';
     echo json_encode($json);
   }
 }
 if(isset($_POST['otp'])){
      $otp=$_POST['otp'];
      if (!empty($otp)) {
      $otpobject->does_otp_verified($otp);
      }
      else{
          $json['status']=100;
     $json['message']='You must fill otp';
     echo json_encode($json);
          
      }
      
     
 }

?>