<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Registrar na Rede Social</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_registrar.css" rel="stylesheet" >
</head>
<body>

    <div class="sidebar"></div>
    
    <div class="form-container-login">

        <div class="logo-chamada-login">
            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/logodanki.svg" />
            <p>Conecte-se com seus amigos e expanda seus aprendizados com a rede social Danki Code.</p>
        </div><!--logo-chamada-login-->

        <div class="form-login">

            <form method="post">
                <input type="text" name="nome" placeholder="Nome Completo">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">
                <input type="password" name="senhaC" placeholder="Confirme sua senha">
                <input type="submit" name="acao" value="Criar conta e entrar">
                <input type="hidden" name="registrar" value="registrar">
            </form>
            <p><a href="<?php echo INCLUDE_PATH ?>home">Já tenho uma conta</a></p>

        </div><!--form-login-->

    </div>
    
</body>
</html>