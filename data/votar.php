<?php

include("../votar/verify.php");

require "../vendor/autoload.php";

use App\Votar\Votar;
use App\SalvarEleitor\SalvarEleitor;
use App\DbConnectMy\DbConnectMy;
use App\Config\Config;


$chapa = $_SESSION['CHAPA'];

$votar = base64_decode($_POST['res']);


$instancia = new Config();
$eleicao = $instancia->eleicao();


$verificaEleitor = (new DbConnectMy('eleitores'))->select("MATRICULA = '$chapa' AND ELEICAO = '$eleicao'");

if ($verificaEleitor->rowCount() != 0) {
    die('Eleitor já votou');
} else {

    // Metodo votar
    $enviaObjVotar = new Votar;
    $enviaObjVotar->id_candidato = $votar;
    $enviaObjVotar->VotarCandidato();

    // Metodo salvar eleitor
    $enviaObjEleitor = new SalvarEleitor;
    $enviaObjEleitor->matricula = $chapa;
    $enviaObjEleitor->Salvar();

    header("Location: ../votar/index.php");
}
