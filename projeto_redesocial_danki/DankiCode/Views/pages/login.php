<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login na Rede Social</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_login.css" rel="stylesheet" >
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
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" name="acao" value="Entrar">
                <input type="hidden" name="login">
            </form>
            <p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar nova conta</a></p>

        </div><!--form-login-->

    </div>
    
</body>
</html>