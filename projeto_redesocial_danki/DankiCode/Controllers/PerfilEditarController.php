<?php
    namespace DankiCode\Controllers;

    class PerfilEditarController{
        public function index(){
            if(isset($_SESSION['login'])){

                if(isset($_POST['atualizar'])){
                    $pdo = \DankiCode\MySql::connect();
                    $nome = strip_tags(($_POST['nome']));
                    $desc = strip_tags(($_POST['user_desc'])); 
                    $senha = $_POST['senha'];
                    $senhaC = $_POST['senhaC'];

                    if($nome == '' && $desc == '' && $senha == ''){
                        \DankiCode\Utilidades::alerta('Os campos estão vazios!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                    }else if($nome != '' && $desc != '' && $senha != ''){
                        if(strlen($senha) < 6){
                            \DankiCode\Utilidades::alerta('Sua senha deve conter ao menos 6 caracteres!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else if($senha != $senhaC){
                            \DankiCode\Utilidades::alerta('Sua senhas não correspondem!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else {
                        $senha = \DankiCode\Bcrypt::hash($senha);
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ?, user_desc = ? WHERE id = ?");
                        $atualizar->execute(array($nome,$senha,$desc,$_SESSION['id']));
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, tudo alterado, entre novamente!');
                        session_unset();
                        session_destroy();
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }else if($nome != '' && $desc != '' && $senha == ''){
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, user_desc = ? WHERE id = ?");
                        $atualizar->execute(array($nome,$desc,$_SESSION['id']));
                        $_SESSION['nome'] = $nome;
                        $_SESSION['nomeC'] = $nome;
                        $_SESSION['user_desc'] = $desc;
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, nome e descrição alterados!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }else if($nome != '' && $desc == '' && $senha == ''){
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
                        $atualizar->execute(array($nome,$_SESSION['id']));
                        $_SESSION['nome'] = $nome;
                        $_SESSION['nomeC'] = $nome;
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, nome alterado!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }else if($nome == '' && $desc != '' && $senha != ''){
                        if(strlen($senha) < 6){
                            \DankiCode\Utilidades::alerta('Sua senha deve conter ao menos 6 caracteres!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else if($senha != $senhaC){
                            \DankiCode\Utilidades::alerta('Sua senhas não correspondem!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else{
                        $senha = \DankiCode\Bcrypt::hash($senha);
                        $atualizar = $pdo->prepare("UPDATE usuarios SET user_desc = ?, senha = ? WHERE id = ?");
                        $atualizar->execute(array($desc,$senha,$_SESSION['id']));
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, descrição e senha alteradas, entre novamente!');
                        session_unset();
                        session_destroy();
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }else if($nome == '' && $desc != '' && $senha == ''){
                        $atualizar = $pdo->prepare("UPDATE usuarios SET user_desc = ? WHERE id = ?");
                        $atualizar->execute(array($desc,$_SESSION['id']));
                        $_SESSION['user_desc'] = $desc;
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, descrição alterada!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfil');
                    }else if($nome != '' && $desc == '' && $senha != ''){
                        if(strlen($senha) < 6){
                            \DankiCode\Utilidades::alerta('Sua senha deve conter ao menos 6 caracteres!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else if($senha != $senhaC){
                            \DankiCode\Utilidades::alerta('Sua senhas não correspondem!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else{
                        $senha = \DankiCode\Bcrypt::hash($senha);
                        $atualizar = $pdo->prepare("UPDATE usuarios SET nome, senha = ? WHERE id = ?");
                        $atualizar->execute(array($nome,$senha,$_SESSION['id']));
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, nome e senha alterados, entre novamente!');
                        session_unset();
                        session_destroy();
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }else if($nome == '' && $desc == '' && $senha != ''){
                        if(strlen($senha) < 6){
                            \DankiCode\Utilidades::alerta('Sua senha deve conter ao menos 6 caracteres!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else if($senha != $senhaC){
                            \DankiCode\Utilidades::alerta('Sua senhas não correspondem!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }else{
                        $senha = \DankiCode\Bcrypt::hash($senha);
                        $atualizar = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
                        $atualizar->execute(array($senha,$_SESSION['id']));
                        \DankiCode\Utilidades::alerta('Perfil Atualizado, senha alterada, entre novamente!');
                        session_unset();
                        session_destroy();
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                        }
                    }

                }

                if(isset($_POST['atualizar-img'])){

                    $pdo = \DankiCode\MySql::connect();
                    
                    if($_FILES['file']['tmp_name'] != ''){
                        $file = $_FILES['file'];
                        // Verificação de tamanho e tipo de arquivo
                        $fileExt = explode('.',$file['name']);
                        $fileExt = $fileExt[count($fileExt) - 1];
                        If($fileExt == 'png' || $fileExt == 'jpg' || $fileExt == 'jpeg'){
                            // Formato válido
                            // Validar tamanho
                            $size = intval($file['size'] / 2048);
                            If($size <= 2048){
                                $uniqid = uniqid().'.'.$fileExt;
                                $atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ? WHERE id = ?");
                                $atualizaImagem->execute(array($uniqid,$_SESSION['id']));
                                $_SESSION['img'] = $uniqid;
                                move_uploaded_file($file['tmp_name'],'C:\xampp\htdocs\projeto_redesocial_danki/uploads/'.$uniqid);
                                \DankiCode\Utilidades::alerta('Sua foto foi atualizada!');
                                \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                                
                            }else {
                                \DankiCode\Utilidades::alerta('Sua imagem é muito grande!');
                                \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                            }
                        }else {
                            \DankiCode\Utilidades::alerta('Formato incompatível!');
                            \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                        }
                    }else{
                        \DankiCode\Utilidades::alerta('Faça upload de uma imagem!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'perfileditar');
                    }
                }

                


            \DankiCode\Views\MainView::render('perfileditar');
            }else{
                \DankiCode\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>