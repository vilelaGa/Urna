<?php

session_start();

//Validação de usuario ativo na sessão
if (!$_SESSION['CHAPA']) {
    header("Location: ../index.php");
    exit();
}
