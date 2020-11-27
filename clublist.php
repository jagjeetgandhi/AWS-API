<?php

require_once __DIR__ . '/configure.php';

class API{
    function select()
    {
        $db = new Connect();
        $users =array();
        $data = $db->prepare('SELECT * FROM stateclub');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[] =array(
                'id'  =>$OutputData['id'],
                'clubName' =>$OutputData['clubName'],
                'state'=>$OutputData['state']
            );
        }
        return json_encode($users);
    }
}

    $API = new API();
    
    header('Content-Type: application/json');

    echo $API->select();




?>