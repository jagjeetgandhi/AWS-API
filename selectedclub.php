<?php

require_once __DIR__ . '/configure.php';

class API{
    function select($state)
    {
        $db = new Connect();
        $users =array();
        $data = $db->prepare("SELECT DISTINCT CLUB_NAME FROM clubstate WHERE ST='$state'");
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[] =array(
                'clubName' =>$OutputData['CLUB_NAME'],   
            );
        }
        return json_encode($users);
    }
}

    $API = new API();
    header('Content-Type: application/json');
if(isset($_POST['state']))
    {
    $state=$_POST['state'];
    if (!empty($state)) {
        echo $API->select($state);
    }else {
    $json['status']=100;
    $json['message']='You must fill state fields';
    echo json_encode($json);
    }
    }

   




?>