<?php


    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


    require_once './../config/db.php';
    require_once './../class/stagiaire.php';


    $database=new Database();
    $db= $database->connect();

    $stgr=new stagiaire($db);

    //GET raw posted data
    $data=json_decode(file_get_contents("php://input"));


    $stgr->cin=$data->cin;


    // Delete post
    if($stgr->Supprimer()) {
        echo json_encode(
        array('message' => 'stagiaire Deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'stagiaire Not Deleted')
        );
    }
