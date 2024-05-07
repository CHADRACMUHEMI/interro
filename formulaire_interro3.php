<!doctype html>
<?php
$con=new PDO("mysql:host=localhost;dbname=bdd_interro_banque","root",'');
?>
<html lang="fr">
    <head>
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
            a:active{
                background-color: #FFCC66

            }


   
        </style>
   </head>
   <body>

   <div class="titre">

    <h1>FORMULAIRE<h1>
    <h3 style="font-seize:16px;color:white;">EPARGNE VOTRE COMPTE<h3>
</div>
    <form method="POST" action="" name="">
        <fieldset>
            <legend>remplire le formulaire CompteEpargne</legend>
            <div class="inputs">
            <label>numero</label>
            <select name="numero">
                <?php
                $req=$con->query("select numero from comptebancaire");
                while($res=$req->fetch()){
                    ?>
                         <option value="<?php echo $res['numero'];?>">
                        <?php echo $res['numero'];?></option>
                        <?php
                }
                ?>
            </select>
            </div>
            
            <div  class="inputs">
            <label>Montant</label>
            <input type="number" name="montant">
            </div>
            <div class="buttons">
            <button name="enrg">Depot_Epargne</button>
            </div>
            
        </fieldset>
    </form>
    <div>
    <a href="formulaire_interro.php"style="font-seize:10px;font-weight:bolder;text-decoration:none;color:red;font-style:italic;box-shadow: 6px 6px 0px black ">GERER VOTRE COMPTE BANCAIRE</a>
    <a href="formulaire_virement.php"style="font-seize:10px;font-weight:bolder;margin-left:450px;text-decoration:none;color:red;font-style:italic;box-shadow: 6px 6px 0px black;">VIRER VOTRE COMPTE VERS UN AUTRE</a><br>
    </div>
    <?php
    include_once("formulaire_epargne.php");
    ?>
   </body>
</html>