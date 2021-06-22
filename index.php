<!DOCTYPE html>
<?php
session_start();

ini_set('display_errors', 0);

if ($_SESSION['usuario'] != '') {

    header('location:dashboard.php');
    //header('Refresh: 0; url=monitor2/monitor2.php.php');
}

$vsHostAcesso = $_SERVER['HTTP_HOST'];
$vsDominio = explode(".", $vsHostAcesso);
$_SESSION['vsBancoCliente'] = "modulos";
//$_SESSION['vsBancoCliente'] = $vsDominio[0];
//print $_SESSION['vsBancoCliente'];

include './header.php';
include './footer.php';
include './config/DBsetup.php';
include './config/config.php';
include './config/conexao.php';
?>

<section class="ftco-section">
    <div class="container">
        
        <div class="row justify-content-center">

            <div class="col-md-6 text-center mb-5">
                <img src="img/logo.png" style="width: 20rem;" id="icon" alt="User Icon" />
            </div>

        </div>


        <div class="row justify-content-center">
            
            <div class="col-md-6 col-lg-4">
                
                <div class="login-wrap p-0">
                    
                    <form action="#" class="signin-form">
                        
                        <div class="form-group">
                            <input id="vsUsuario" type="text" class="form-control" placeholder="Usuário" required>
                        </div>
                        
                        <div class="form-group">
                            <input id="vsSenha" type="password" class="form-control" placeholder="Senha" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3" onclick="Logar();">Entrar</button>
                        </div>
                        
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Lembrar-me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="#" style="color: #fff">Esqueceu a senha?</a>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
        
        
    </div>
</section>