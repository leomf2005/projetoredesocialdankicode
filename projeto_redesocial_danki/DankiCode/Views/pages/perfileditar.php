<!DOCTYPE html>

<html>
 
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo, <?php echo $_SESSION['nome']?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_perfileditar.css" rel="stylesheet" >
</head>

<body>
    
    <section class="main-feed">
        <?php include('includes/sidebar.php')?>
		<div class="feed">
            <div class="editar-perfil">
                <h2>Editar Perfil :</h2>
                <br>
                <br>
                <?php
                    if(isset($_SESSION['img']) && $_SESSION['img'] == ''){
                        echo '<img src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';
                    }else{
                     echo '<img src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" />';
                    }
                ?>
                <div class="form-img">
                    <form method="post" enctype="multipart/form-data">
                        <h4>Escolher imagem de perfil :</h4>
                        <input type="file" name="file">
                        <input type="hidden" name="atualizar-img" value="atualizar-img">
                        <input type="submit" name="acao" value="Enviar imagem">
                    </form>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="nome" placeholder="<?php echo $_SESSION['nomeC'] ?>">
                    <input type="text" name="user_desc" placeholder="Sua descrição...">
                    <input type="password" name="senha" placeholder="Sua nova senha...">
                    <input type="password" name="senhaC" placeholder="Confirme sua nova senha...">
                    <input type="hidden" name="atualizar" value="atualizar">
                    <input type="submit" name="acao" value="Salvar">
                </form>
            </div>

		</div><!--feed-->
    </section><!--main-feed-->

</body>

</html>