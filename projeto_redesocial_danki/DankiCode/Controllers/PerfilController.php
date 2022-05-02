<?php
    namespace DankiCode\Controllers;

    class PerfilController{
        public function index(){
            if(isset($_SESSION['login'])){

                if(isset($_GET['removerAmizade'])){
                    $idEnviou = (int) $_GET['removerAmizade'];
                    \DankiCode\Models\UsuariosModel::atualizarAmizade($idEnviou,0);
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                }else if(isset($_GET['nadaAmizade'])){
                    $idEnviou = (int) $_GET['nadaAmizade'];
                    if(\DankiCode\Models\UsuariosModel::atualizarAmizade($idEnviou,1)){
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }else{
                        \DankiCode\Utilidades::alerta('Ops... Um erro aconteceu!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }
                }
                
            \DankiCode\Views\MainView::render('perfil');
            }else{
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>