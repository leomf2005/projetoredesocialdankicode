<?php
    namespace DankiCode\Controllers;

    class RegistrarController{

        public function index(){

                if(isset($_POST['registrar'])){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $senhaC = $_POST['senhaC'];

                    if($nome == null && $nome){
                        \DankiCode\Utilidades::alerta('Nome inválido.');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        \DankiCode\Utilidades::alerta('Email inválido.');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    }else if(strlen($senha) < 6){
                        \DankiCode\Utilidades::alerta('Sua senha deve conter ao menos 6 caracteres!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    }else if($senha != $senhaC){
                        \DankiCode\Utilidades::alerta('Sua senhas não correspondem!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    }else if(\DankiCode\Models\UsuariosModel::emailExists($email)){
                        \DankiCode\Utilidades::alerta('Este email já está cadastrado!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH.'registrar');
                    }else{
                        // Registrar usuario
                        $senha = \DankiCode\Bcrypt::hash($senha);
                        $registro = \DankiCode\MySql::connect()->prepare("INSERT INTO usuarios VALUES (null,?,?,?,'','','')");
                        $registro->execute(array($nome,$email,$senha));

                        \DankiCode\Utilidades::alerta('Registrado com sucesso!');
                        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
                    }

                }
                // Renderizar para criar conta
                \DankiCode\Views\MainView::render('registrar');
            

        }

    }

?>