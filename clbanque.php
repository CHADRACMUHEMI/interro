<?php
$con=new PDO("mysql:host=localhost;dbname=bdd_interro_banque","root",'');
class compteBancaire{
    public $numero;
    public $titulaire;
    public $solde;
    public function __construct($lenumero,$letitulaire,$lesolde){
        $con=new PDO("mysql:host=localhost;dbname=bdd_interro_banque","root",'');
        $this->numero=$lenumero;
        $this->titulaire=$letitulaire;
        $this->solde=$lesolde;
    }
    public function Depot($montant){
       $this->solde=$this->solde+$montant;
       return $this->solde;
    }
    public function Retrait($montant){
        $this->solde=$this->solde-$montant;
        return $this->solde;
    }
    public function Solder(){
        $this->solde=$this->solde-$this->solde;
        return $this->solde;
    }
    public function Virer($montant){
        $this->solde=$this->solde-$montant;
        return $this->solde;
        
        
    }
    public function Decrire(){
        return "le compte numero est: ".$this->numero." dont le titulaire est:".$this->titulaire."dont le solde est:".$this->solde;

    }

}
class compteepargne extends compteBancaire{
    public $interets;
    public function __construct($lenumero,$letitulaire,$lesolde){
        $this->numero=$lenumero;
        $this->solde=$lesolde;
        $this->titulaire=$letitulaire;
        $this->interets=$this->solde*0.035;


    }
    public function DepotEpargne($montant){
        $this->solde=$this->solde+$montant;
       
       return $this->solde;

    }
    public function DecrireEpargne($compte){
        return "votre solde epargne avec interet de trois virgule cinq est : ".$this->solde; 

    }
}
?>