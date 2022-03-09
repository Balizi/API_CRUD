<?php

class stagiaire{

    private $conn;

    public $cin;
    public $nom;
    public $prenom;
    public $niveau;
    public $specialite;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn=$db;
    }


    public function Afficher()
    {
        $req='SELECT * FROM stagiaire';
        $stmt=$this->conn->prepare($req);
        $stmt->execute();
        return $stmt;
    }

    public function chercher()
    {
        $req='SELECT * FROM stagiaire WHERE cin=?';
        $stmt=$this->conn->prepare($req);
        $stmt->bindParam(1, $this->cin);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        // die(var_dump($row));
        $this->cin=$row['cin'];
        $this->nom=$row['nom'];
        $this->prenom=$row['prenom'];
        $this->niveau=$row['niveau'];
        $this->specialite=$row['specialite'];
    }


    public function Ajouter()
    {
        $req='INSERT INTO stagiaire VALUES(:cin,:nom,:prenom,:niveau,:specialite)';
        $stmt=$this->conn->prepare($req);
        $this->cin=htmlspecialchars(strip_tags($this->cin));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->niveau=htmlspecialchars(strip_tags($this->niveau));
        $this->specialite=htmlspecialchars(strip_tags($this->specialite));

        $stmt->bindParam(':cin',$this->cin);
        $stmt->bindParam(':nom',$this->nom);
        $stmt->bindParam(':prenom',$this->prenom);
        $stmt->bindParam(':niveau',$this->niveau);
        $stmt->bindParam(':specialite',$this->specialite);

        if($stmt->execute())
        {
            return true;
        }

        printf("error d'insertion");
        return false;
    }

    public function Modifier()
    {
        $req='UPDATE stagiaire set nom=:nom,prenom=:prenom,niveau=:niveau,specialite=:specialite where cin=:cin';
        $stmt=$this->conn->prepare($req);
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->niveau=htmlspecialchars(strip_tags($this->niveau));
        $this->specialite=htmlspecialchars(strip_tags($this->specialite));
        $this->cin=htmlspecialchars(strip_tags($this->cin));

        
        $stmt->bindParam(':nom',$this->nom);
        $stmt->bindParam(':prenom',$this->prenom);
        $stmt->bindParam(':niveau',$this->niveau);
        $stmt->bindParam(':specialite',$this->specialite);
        $stmt->bindParam(':cin',$this->cin);

        if($stmt->execute())
        {
            return true;
        }

        printf("error de modification");
        return false;

    }


    public function Supprimer()
    {
        $req='DELETE FROM stagiaire WHERE cin=:cin';
        $stmt=$this->conn->prepare($req);
        $this->cin=htmlspecialchars(strip_tags($this->cin));
        $stmt->bindParam(':cin',$this->cin);
        if($stmt->execute())
        {
            return true;
        }

        printf("error de suppression");
        return false;
    }


}

?>