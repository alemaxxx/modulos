<?php

session_start();

include 'config/conexao.php';

include_once 'class/Login.php';
include 'class/RedefinirSenha.php';

function Logar() {

    //phpAntiInjectionSql();

    $vaRetorno = array();
    $voClasse = new Login();

    $vsUsuario = $_POST['vsUsuario'];
    $vsSenha = $_POST['vsSenha'];

    $vbRetorno = $voClasse->Logar($vsUsuario, $vsSenha);

    if ($vbRetorno) {

        $vaRetorno['RETORNO'] = true;
        $vaRetorno['DADOS'] = $voClasse->getVaDados();
        
        
        $_SESSION['usuario'] = $vsUsuario;
        $_SESSION['NivelAcesso'] = $vaRetorno['DADOS']['NIVEL_ACESSO'][0];

    } else {

        $_SESSION['usuario'] = '';

        $vaRetorno['RETORNO'] = false;
    }

    echo json_encode($vaRetorno);
}

function RedefinirSenha() {

    //phpAntiInjectionSql();
    
    $vaRetorno = array();
    $voClasse = new RedefinirSenha();

    $vsEmail = $_POST['vsEmail'];

    $vbRetorno = $voClasse->EnviarEmail($vsEmail);

    if ($vbRetorno) {

        $vaRetorno['RETORNO'] = true;
        $vaRetorno['DADOS'] = $voClasse->getVaDados();

    } else {

        $vaRetorno['RETORNO'] = false;
    }

    echo json_encode($vaRetorno);
}

function Sair() {

    $_SESSION['usuario'] = '';
    $_SESSION['NivelAcesso'] = '';

    $vaRetorno['RETORNO'] = true;
    
    echo json_encode($vaRetorno);
}

if (isset($_POST['vsFunction'])) {
    $_POST['vsFunction']();
}
?>