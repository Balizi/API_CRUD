<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once './../config/db.php';
    require_once './../class/stagiaire.php';

    $database=new Database();
    $db= $database->connect();

    $stgr=new stagiaire($db);

    $stgr->cin=isset($_GET['cin'])?$_GET['cin']:die();

    $stgr->chercher();

    $stgr_arr=array(
        'cin'=>$stgr->cin,
        'nom'=>$stgr->nom,
        'prenom'=>$stgr->prenom,
        'niveau'=>$stgr->niveau,
        'specialite'=>$stgr->specialite,
    );

    print_r(json_encode($stgr_arr));

