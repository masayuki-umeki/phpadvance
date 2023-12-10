<?php

// print_r($_REQUEST);
// print_r($_FILES);

$action = $_REQUEST['action'];

if (!empty($action)) {
    require_once 'partials/User.php';
    $obj = new User();
}

// adding user action
if ($action == 'adduser' && !empty($_POST)) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo'];

    $playerid = !empty($_POST['userId']) ? $_POST['userid'] : "";

    $imagename = "";
    if (!empty($photo['name'])) {
        $imagename = $obj->uploadPhoto($photo);
        $playerData = [
            'name' => $username,
            'email' => $email,
            'mobile' => $mobile,
            'photo' => $imagename,
        ];
    } else {
        $playerData = [
            'name' => $username,
            'email' => $email,
            'mobile' => $mobile,
        ];
    }

    $playerid = $obj->add($playerData);
    if (!empty($playerid)) {
        $player = $obj->getRow('id', $playerid);
        echo json_encode($player);
        exit();
    }
} 

?>