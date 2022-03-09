<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    // header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with");


    require_once './../config/db.php';
    require_once './../class/stagiaire.php';


    $database=new Database();
    $db= $database->connect();

    $stgr=new stagiaire($db);

    //GET raw posted data
    $data=json_decode(file_get_contents("php://input"));

    $stgr->cin=$data->cin;
    $stgr->nom=$data->nom;
    $stgr->prenom=$data->prenom;
    $stgr->niveau=$data->niveau;
    $stgr->specialite=$data->specialite;

    if($stgr->Modifier())
    {
        echo json_encode(
            array('message'=>'Stagiaire Modifier')
        );
    }else{
        echo json_encode(
            array('message'=>'Stagiaire non modifier')
        );
    }


    