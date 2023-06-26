<?php

namespace App\Login;

use App\DbConnectSRV\DbConnectSRV;
use PDO;

class Login
{

    /**
     * Função que loga o colaborador
     * 2 Parametros necessarios
     * @var int ra
     * @var int cpf
     * OBS: CPF SÃO OS 6 PRIMEIROS DIGITOS 000000
     */
    public static function Login($ra, $cpf)
    {

        //FUNÇÃO LOGIN CHAMADA E UM SELECT personalizado DENTRO DE DbConnectSRV 
        $dadosUni = (new DbConnectSRV())->LOGIN('PFUNC PF INNER JOIN PPESSOA PE ON PF.CODPESSOA = PE.CODIGO', "PF.CHAPA = '$ra' AND PF.CODSITUACAO IN ('A', 'F') AND PF.CODTIPO NOT IN ('A', 'T', 'Z') AND PF.CODSECAO NOT LIKE '1.08%'")
            ->fetch(PDO::FETCH_ASSOC);

        $cpfDb = $dadosUni['CPF'];
        // echo $cpfDb;
        // die();

        $splitCpf = str_split($cpfDb);

        $cpfSplitado = $splitCpf[0] . $splitCpf[1] . $splitCpf[2] . $splitCpf[3] . $splitCpf[4] . $splitCpf[5];

        if ($cpf == $cpfSplitado) {

            $raSession = $dadosUni['CHAPA'];
            $_SESSION['CHAPA'] = $raSession;
            header("Location: ../votar/");
        } else {
            $_SESSION['userInvalido'] = true;
            header("Location: ../index.php");
        }
    }
}
