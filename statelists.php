<?php

require_once __DIR__ . '/configure.php';

class APIState{
    function select()
    {
        $db = new Connect();
        $users =array();
        $data = $db->prepare("SELECT DISTINCT ST FROM clubstate");
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[] =array(
                'state' =>$OutputData['ST'],   
            );
        }
        return json_encode($users);
    }
}

    $APIState = new APIState();
    echo $APIState ->select();
    header('Content-Type: application/json');


   




?>