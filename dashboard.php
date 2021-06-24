<?php


session_start();

if ($_SESSION['usuario'] == '') {

    header('location:index.php');
}

include "header.php";
include "config/config.php";
include "config/conexao.php";
include "footer.php";
include "menu_lateral.php";
include "ajax.php";

?>