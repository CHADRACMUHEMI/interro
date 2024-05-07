<?php
include("clbanque.php");
if(isset($_POST['enrg'])){
    $numero=$_POST['numero'];
    $montant=$_POST['montant'];
    $req=$con->prepare("select * from compteepargne where numero=?");
    $req->execute(array($_POST['numero']));
    while($resultat=$req->fetch()){
        $comptepargne=new compteepargne($resultat['numero'],$resultat['titulaire'],$resultat['solde']);
        $solde=$comptepargne->Depot($_POST['montant']);
        $req=$con->prepare("update compteepargne set solde=?,interets=solde*0.035 where numero=?");
        $req->execute(array($solde,$_POST['numero']));

    }
}

?>