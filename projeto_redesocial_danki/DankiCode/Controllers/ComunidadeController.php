<?php
    namespace DankiCode\Controllers;

    class ComunidadeController{
        public function index(){
            if(isset($_SESSION['login'])){

                if(isset($_GET['solicitarAmizade'])){
                    $idPara= (int) $_GET['solicitarAmizade'];
                    if(\DankiCode\Models\UsuariosModel::solicitarAmizade($idPara)){
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }else{
                        \DankiCode\Utilidades::alerta('Ocorreu um erro ao solicitar amizade.');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }
                }

                if(isset($_GET['recusarAmizade'])){
                    $idPara = (int) $_GET['recusarAmizade'];
                    \DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idPara,0);
                }else if(isset($_GET['aceitarAmizade'])){
                    $idPara = (int) $_GET['aceitarAmizade'];
                    if(\DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idPara,1)){

                    }else{
                        \DankiCode\Utilidades::alerta('Ops... Um erro aconteceu!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }
                }

                if(isset($_GET['removerPedidoAmizade'])){
                    $idPara= (int) $_GET['removerPedidoAmizade'];
                    if(\DankiCode\Models\UsuariosModel::removerPedidoAmizade($idPara)){
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }else{
                        \DankiCode\Utilidades::alerta('Ocorreu um erro ao cancelar o pedido.');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }
                }


                if(isset($_GET['removerAmizade'])){
                    $idEnviou = (int) $_GET['removerAmizade'];
                    \DankiCode\Models\UsuariosModel::atualizarAmizade($idEnviou,0);
                    \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                }else if(isset($_GET['nadaAmizade'])){
                    $idEnviou = (int) $_GET['nadaAmizade'];
                    if(\DankiCode\Models\UsuariosModel::atualizarAmizade($idEnviou,1)){
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }else{
                        \DankiCode\Utilidades::alerta('Ops... Um erro aconteceu!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'comunidade');
                    }
                }


            \DankiCode\Views\MainView::render('comunidade');
            }else{
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>