<?php
    namespace DankiCode\Controllers;

    class HomeController{

        public function index(){

            if(isset($_GET['logout'])){
                session_unset();
                session_destroy();

                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }

            if(isset($_SESSION['login'])){
                // Renderiza a home do usuário

                // Existe pedido de amizade?
                if(isset($_GET['recusarAmizade'])){
                    $idEnviou = (int) $_GET['recusarAmizade'];
                    \DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,0);
                }else if(isset($_GET['aceitarAmizade'])){
                    $idEnviou = (int) $_GET['aceitarAmizade'];
                    if(\DankiCode\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou,1)){

                    }else{
                        \DankiCode\Utilidades::alerta('Ops... Um erro aconteceu!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }
                }

                // Existe postagem no feed?

                if(isset($_POST['post_feed'])){

                    if($_POST['post_content'] == '' || strlen($_POST['post_content'] < 10)){
                        \DankiCode\Utilidades::alerta('Não permitimos posts vazios!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }

                    \DankiCode\Models\HomeModel::postFeed($_POST['post_content']);

                }
                
                \DankiCode\Views\MainView::render('home');
            }else{
                // Renderizar para criar conta

                if(isset($_POST['login'])){
                    $login = $_POST['email'];
                    $senha = $_POST['senha'];

                    // Verificar no banco de dados

                    $verificar = \DankiCode\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
                    $verificar->execute(array($login));

                    if($verificar->rowCount() == 0){
                        // Não existe usuário
                        \DankiCode\Utilidades::alerta('Há campos incorretos!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }else{
                        $dados = $verificar->fetch();
                        $senhaBanco = $dados['senha'];
                        if(\DankiCode\Bcrypt::check($senha,$senhaBanco)){
                            // Usuario logado com sucesso
                            $_SESSION['nomeC'] = $dados['nome'];
                            $_SESSION['login'] = $dados['email'];
                            $_SESSION['id'] = $dados['id'];
                            $_SESSION['nome'] = explode(' ',$dados['nome'])[0];
                            $_SESSION['user_desc'] = $dados['user_desc'];
                            $_SESSION['img'] = $dados['img'];
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }else{
                            \DankiCode\Utilidades::alerta('Senha incorreta.');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }

                }

                \DankiCode\Views\MainView::render('login');
            }

        }

    }

?>