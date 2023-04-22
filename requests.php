<?php

include_once('db_connect.php');
$action = $_REQUEST['action'];

// $sql = "SELECT * FROM romote_keys";
// $result = $conn->query($sql);
// $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($rows);die;

switch($action){
    case "fetch": 
        $sql = "SELECT * FROM romote_keys";
        $result = $conn->query($sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if(count($rows) > 0){
            echo json_encode(["st" => 1, "msg" => "record fetched successfully", "data" => $rows]);
        }else{
            echo json_encode(["st" => 0, "msg" => "record not found!!", "data" => $rows]);
        }

        break;
        
    case "update": 
            $key = $_REQUEST['key'];
            $color = $_REQUEST['color'];
            $sql = "UPDATE romote_keys SET color='".$color."' WHERE id=$key";
            if ($conn->query($sql) === TRUE) {

                $sql = "UPDATE aquire_control_by SET acessupto_time=0 WHERE id=1";
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(["st" => 1, "msg" => "Record updated successfully", "data" => []]);
                } else {
                    echo json_encode(["st" => 0, "msg" => "Error updating record: " . $conn->error, "data" => []]);
                }
            } else {
                echo json_encode(["st" => 0, "msg" => "Error updating record: " . $conn->error, "data" => []]);
            }
        break;

    case "acquireControl": 
        $user = $_REQUEST['user'];
        $time = time()+120;
        $sql = "UPDATE aquire_control_by SET user_id=$user, acessupto_time=$time WHERE id=1";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["st" => 1, "msg" => "Record updated successfully", "data" => []]);
        } else {
            echo json_encode(["st" => 0, "msg" => "Error updating record: " . $conn->error, "data" => []]);
        }
    break;
    
    case "checkControlPause": 
        $user = $_REQUEST['user'];
        $sql = "SELECT * FROM aquire_control_by WHERE id=1";
        $result = $conn->query($sql);
        if($result->num_rows  > 0){
            $row = $result->fetch_assoc();
            if($user == $row['user_id']){
                $time = 0;
                $type = "aquired";
            }else{
                if($row['acessupto_time'] < time()){
                    $time = 0;
                }else{
                    $time = $row['acessupto_time']-time();
                }
                $type = "notaquired";
               
            }
            echo json_encode(["st" => 1, "msg" => "record fetched successfully", "data" => ["type" => $type,"time" => $time]]);
        }else{
            echo json_encode(["st" => 0, "msg" => "record not found!!", "data" => []]);
        }

    break; 

    case "reset": 
        $color = "white";
        $sql = "UPDATE romote_keys SET color='".$color."'";
        if ($conn->query($sql) === TRUE) {
            
            $sql = "UPDATE aquire_control_by SET acessupto_time=0, user_id='0' WHERE id=1";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["st" => 1, "msg" => "Reset successfully", "data" => []]);
            } else {
                echo json_encode(["st" => 0, "msg" => "Error updating record: " . $conn->error, "data" => []]);
            }
        } else {
            echo json_encode(["st" => 0, "msg" => "Error updating record: " . $conn->error, "data" => []]);
        }
    break;
}

?>