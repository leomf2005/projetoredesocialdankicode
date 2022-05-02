<!DOCTYPE html>

<html>
 
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo, <?php echo $_SESSION['nome']?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_perfil.css" rel="stylesheet" >
</head>

<body>
    
    <section class="main-feed">
        <?php include('includes/sidebar.php')?>
		<div class="feed">
            <div class="perfil">
                <div class="perfil-wraper">
                        <div class="box-img">
                            <?php
                                if(isset($_SESSION['img']) && $_SESSION['img'] == ''){
                                    echo '<img src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';
                                }else{
                                echo '<img src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" />';
                                }
                            ?>
                        </div>

                        <div class="info-perfil">
                            <h2><?php echo $_SESSION['nomeC'] ?></h2>
                            <a href="<?php echo INCLUDE_PATH ?>perfileditar">Editar Perfil</a>
                            <?php If(isset($_SESSION['user_desc']) && $_SESSION['user_desc'] == ''){ ?>
                                <p>Sua bio...</p>
                            <?php }else{ ?>    
                            <p><?php echo $_SESSION['user_desc'] ?></p>
                            <?php }?>
                        </div>
                </div>
            </div>    

                    <div class="friends-list">
                        <h4>Amigos</h4>
                        <div class="container-comunidade-wraper">
                        <?php
                            foreach(\DankiCode\Models\UsuariosModel::listarAmigos() as $key => $value){
                        ?>
                            <div class="container-comunidade-single">
                                <div class="img-comunidade-user-single">

                                <?php if(!isset($value['me']) && $value['img'] == ''){ ?>
                                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
                                <?php }else if(!isset($value['me'])){ ?>
                                    <img src="<?php echo INCLUDE_PATH?>uploads/<?php echo $value['img']; ?>" >
                                <?php } ?>
                                <?php if(isset($value['me']) && $_SESSION['img'] == ''){ ?>
                                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
                                <?php }else if(isset($value['me'])){ ?>
                                    <img src="<?php echo INCLUDE_PATH?>uploads/<?php echo $_SESSION['img']; ?>" >
                                <?php } ?>
                                </div>
                                <div class="info-comunidade-user-single">
                                    <h2><?php echo $value['nome']?></h2>
                                    <p><?php echo $value['email']?></p>
                                        <div class="btn-solicitar-amizade">
                                            <p><a href="<?php echo INCLUDE_PATH ?>perfil?removerAmizade=<?php echo $value['id']?>">Remover Amizade</a></p>
                                        </div>
                                </div>
                            </div>	

                            <?php }
                            
                        ?>
                    </div>

		</div><!--feed-->
    </section><!--main-feed-->

</body>

</html>