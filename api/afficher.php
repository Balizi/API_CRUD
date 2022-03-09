<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once './../config/db.php';
    require_once './../class/stagiaire.php';

    $database=new Database();
    $db= $database->connect();

    $stgr=new stagiaire($db);
    $res=$stgr->Afficher();
    
    $num=$res->rowCount();
    // echo $num;
    if($num>0)
    {
        $stgr_arr=array();
        $stgr_arr['data']=array();
        while($row=$res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $stgr_item=array(
                'cin'=>$cin,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'niveau'=>$niveau,
                'specialite'=>$specialite
            );
            array_push($stgr_arr['data'],$stgr_item);
        }
        echo json_encode($stgr_arr);
    }
    else{
        //no stagiaire
        echo json_encode(
            array('message'=>'No Post Found')
        );
    }

