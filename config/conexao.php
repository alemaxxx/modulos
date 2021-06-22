<?php

function conecta_db() {

    
    //$voConexao = mysqli_connect(vsDbHost,vsUsrDb,vsPassDb, vsDbName);
    
    //Notebook
    //$voConexao = mysqli_connect($_SESSION['vsHostBD'], $_SESSION['vsUsuarioDB'], $_SESSION['vsSenhaBD'], $_SESSION['vsBancoDados']);
    
    //cobraservice.orgfree.com
    //$voConexao = mysqli_connect("localhost", "1229252", "soporhoje", "1229252");
    
    //ubuntu
    //$voConexao = mysqli_connect("localhost", "root", "", $_SESSION['vsBancoDados']);
    
    $voConexao = mysqli_connect("localhost", "root", "soporhoje", 'modulos');
    
    
    $voConexao->autocommit(FALSE);

    return $voConexao;
}

?>