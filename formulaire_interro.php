<!doctype html>
<?php
$con=new PDO("mysql:host=localhost;dbname=bdd_interro_banque","root",'');
require("clbanque.php");
?>
<html lang="fr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <style>
            body{
                width: 100%;
               padding:0px;
               margin:0px;
               box-sizing:border-box;
               
               
            }
            form{
                border:1px solid #f5f5f5;
                width:30%;
                height:auto;
                padding:5px;              
                display:flex;             
                justify-content:center;
                align-items:center;
                margin-top: 9rem;
                box-shadow:2px 2px 3px #f5f5f5;
                margin-left:350px;
             
                
            }
            form h1{
                font-size:20px;
                width:100%;
                height:3rem;
                padding:3px;
                background-color: #f5f5f5;
                text-align:center;
                text-transform:capitalize;
            }
            form .inputs{
                width:100%;
                height:auto;
                display:flex;
                flex-direction:column;
                
            }
            form .inputs input{
                width:80%;
                height:25px;
                outline:none;
                border-radius:5px;
                border:none;
                border-bottom:2px solid #f5f5f5;
                padding:2px;
                right:10px;
                
                

            }
            form .inputs label{
                text-align:left;
                left:0;
                font-weight:100;
                font-family: serif;
            }
            form .buttons{
                display:flex;
                flex-direction:row;
                flex-wrap:wrap;
                width:100%;

            }
            form .buttons button{
                margin-left: 5px;
                border:1px solid blue;
                padding:5;
                border-radius:10px;
                font-weight:bolder;
                color:black;
                margin-top: 10px;
            }
            form .buttons button:hover{
                background-color: #000;
                color:white;
            }
            .titre{
                width:100%;
                padding:5px;
                background-color:blue;
            }
            a:active
{
background-color: #FFCC66
}
         
            
        </style>
   </head>
   <body>
    <div class="titre">

        <h1>FORMULAIRE<h1>
        <h3 style="font-seize:16px;color:white">ENRREGISTREMENT COMPTE BANQUE<h3>
    </div>


    <form method="POST" action="" name="">
        <fieldset>
            <legend>remplire le formulaire compte bancaire</legend>
            <div class="inputs">
            <label>numero</label>
            <input type="number" name="num">
            </div>
            <div class="inputs">
            <label>titulaire</label>
            <input type="text" name="tit">
            </div>
            <div class="inputs">
            <label>solde</label>
            <input type="number" name="solde">
            </div  class="inputs">
            <div  class="inputs">
            <label>Montant</label>
            <input type="number" name="montant">
            </div>
            <div class="buttons">
            <button name="enreg">ENRREGISTRAIT</button>
            <button name="depot">DEPOT</button>
            <button name="retrait">RETRAIT</button>
            <button name="solde">SOLDER</button>
            </div>
       </fieldset>   
    </form>
    <div>
    <a href="formulaire_interro3.php"style="font-seize:10px;font-weight:bolder;text-decoration:none; color:red;font-style:italic;box-shadow: 6px 6px 0px black;"> EPARGNER VOTRE COMPTE</a>
    <a href="formulaire_virement.php"style="font-seize:10px;font-weight:bolder;margin-left:600px;text-decoration:none;color:red;font-style:italic;box-shadow: 6px 6px 0px black;"> VIIRER VOTRE COMPTE VERS UN AUTRE</a>
    </div>
    

    <?php
    //insertion de la base de donnee
    if(isset($_POST["enreg"])){
        $nume=$_POST['num'];
        $titulaire=$_POST['tit'];
        $solde=$_POST['solde'];
        $con->exec("insert into comptebancaire(numero,titulaire,solde) values('$nume','$titulaire','$solde')");

        $req=$con->prepare("insert into compteepargne values(?,?,?,?)");
        $req->execute(array($_POST['num'],0,$_POST['tit'],0));
    }
    elseif(isset($_POST['depot'])){
        $nume=$_POST['num'];
        $solde;
        $req=$con->prepare("select *from comptebancaire where numero=:numero");
        $req->execute(array(
            'numero'=>$nume
        ));
        while($resultat=$req->fetch()){
            $comptebancaire=new compteBancaire($resultat['numero'],$resultat['titulaire'],$resultat['solde']);
            $solde=$comptebancaire->Depot($_POST['montant']);
            $req1=$con->prepare("update comptebancaire set solde=:solde where numero=:num");
            $req1->execute(array(
                'solde'=>$solde,
                'num'=>$nume
            ));
            echo $comptebancaire->Decrire();
        }
        
    }
    elseif(isset($_POST['retrait'])){
        $nume=$_POST['num'];
        $solde;
        $req=$con->prepare("select *from comptebancaire where numero=:numero");
        $req->execute(array(
            'numero'=>$nume
        ));
        while($resultat=$req->fetch()){
            $comptebancaire=new compteBancaire($resultat['numero'],$resultat['titulaire'],$resultat['solde']);
            $solde=$comptebancaire->Retrait($_POST['montant']);
            $req1=$con->prepare("update comptebancaire set solde=:solde where numero=:num");
            $req1->execute(array(
                'solde'=>$solde,
                'num'=>$nume
            ));
            echo $comptebancaire->Decrire();
        }
    }
    elseif(isset($_POST['solde'])){
        $nume=$_POST['num'];
        $solde;
        $req=$con->prepare("select *from comptebancaire where numero=:numero");
        $req->execute(array(
            'numero'=>$nume
        ));
        while($resultat=$req->fetch()){
            $comptebancaire=new compteBancaire($resultat['numero'],$resultat['titulaire'],$resultat['solde']);
            $solde=$comptebancaire->Solder($_POST['montant']);
            $req1=$con->prepare("update comptebancaire set solde=:solde where numero=:num");
            $req1->execute(array(
                'solde'=>$solde,
                'num'=>$nume
            ));
            echo $comptebancaire->Decrire();
        }
    }
        
    ?>
   </body>
</html>