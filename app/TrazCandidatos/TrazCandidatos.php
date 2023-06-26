<?php

namespace App\TrazCandidatos;

use App\Config\Config;
use App\DbConnectMy\DbConnectMy;
use PDO;


class TrazCandidatos
{

    public static function Candidatos($tipo)
    {

        $instancia = new Config();

        $eleicao = $instancia->eleicao();

        $var = (new DbConnectMy('candidatos'))->select("TIPO = '$tipo' AND ELEICAO = '$eleicao'");
        $linha = $var->fetchAll(PDO::FETCH_ASSOC);

        return $linha;
    }
}
