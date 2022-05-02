<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo, <?php echo $_SESSION['nome']?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_feed.css" rel="stylesheet" >
</head>

<body>
    
    <section class="main-feed">
        <?php include('includes/sidebar.php')?>
        <div class="feed">
            <div class="feed-wraper">
                <div class="feed-form">
                    <form method="post">
                            <textarea name="post_content" placeholder="Digite aqui sua postagem..." required=""></textarea>
                            <input type="hidden" name="post_feed">
                            <input type="submit" name="acao" value="Publicar">
                    </form>
                </div><!--feed-form-->
                <?php
                    $retrievePosts = \DankiCode\Models\HomeModel::retrieveFriendsPosts();
                    foreach ($retrievePosts as $key => $value) {
                        # code...
                ?>
                    <div class="feed-single-post">
                        <div class="feed-single-post-author">
                            <div class="img-single-post-author">

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
                            <div class="feed-single-post-author-info">
                                <?php If(isset($value['me'])) {?>
                                    <h3><?php echo $_SESSION['nomeC'];?> (eu)</h3>
                                <?php }else{ ?>

                                    <h3><?php echo $value['usuario'];?></h3>

                                <?php }?>
                                <p><?php echo date('d/m/Y H:i:s',strtotime($value['data']))?></p>
                            </div>
                        </div>
                        <div class="feed-single-post-content">
                            <p><?php echo $value['conteudo']?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
                <div class="friends-request-feed">
                    <h4>Solicitações de amizade</h4>
                    <?php
                        foreach(\DankiCode\Models\UsuariosModel::listarAmizadesPendentes() as $key => $value){
                            $usuarioInfo = \DankiCode\Models\UsuariosModel::getUsuarioById($value['enviou']);

                    ?>
                    
                    <div class="friend-request-single">
                        
                    <?php if(!isset($usuarioInfo['me']) && $usuarioInfo['img'] == ''){ ?>
                                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
                                <?php }else if(!isset($usuarioInfo['me'])){ ?>
                                    <img src="<?php echo INCLUDE_PATH?>uploads/<?php echo $usuarioInfo['img']; ?>" >
                                <?php } ?>
                                <?php if(isset($usuarioInfo['me']) && $_SESSION['img'] == ''){ ?>
                                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
                                <?php }else if(isset($usuarioInfo['me'])){ ?>
                                    <img src="<?php echo INCLUDE_PATH?>uploads/<?php echo $_SESSION['img']; ?>" >
                                <?php } ?>
                            <div class="friend-request-single-info">
                            <h3><?php echo $usuarioInfo['nome']?></h3>
                            <p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id'] ?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id'] ?>">Recusar</a></p>
                            </div>
                    </div>

                    <?php
                        }
                    ?>
                </div>
        </div><!--feed-->
    </section><!--main-feed-->

</body>

</html>