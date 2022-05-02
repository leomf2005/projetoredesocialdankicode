<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>styles/feed.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_comunidade.css" rel="stylesheet">


</head>

<body>

	<section class="main-feed">
		<?php include('includes/sidebar.php')?>
		<div class="feed">
			<div class="comunidade">
			<div class="container-comunidade">
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
										<p><a href="<?php echo INCLUDE_PATH ?>comunidade?removerAmizade=<?php echo $value['id']?>">Remover Amizade</a></p>
									</div>
							</div>
						</div>	

						<?php }
						
					?>
			</div>
			<br/>

				<div class="container-comunidade">
					<h4>Comunidade</h4>
					<div class="container-comunidade-wraper">

						<?php
							$comunidade = \DankiCode\Models\UsuariosModel::listarComunidade();

							foreach ($comunidade as $key => $value) {

								$pdo = \DankiCode\MySql::connect();
								$verificarAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");
								$verificarAmizade->execute(array($value['id'],$_SESSION['id'],$_SESSION['id'],$value['id']));
								if($verificarAmizade->rowCount() == 1){
									// São amigos, sem necessidade de listar
									continue;
								}

								if($value['id'] == $_SESSION['id']){
									continue;
								}
							
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
								<h2><?php echo $value['nome'] ?></h2>
								<p><?php echo $value['email'] ?></p>
								<div class="btn-solicitar-amizade">
								<?php
										if(\DankiCode\Models\UsuariosModel::existePedidoAmizadeEuFiz($value['id'])){
								?>
									<p><a href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id'] ?>">Solicitar Amizade</a></p>
								<?php
										}else {
											if(\DankiCode\Models\UsuariosModel::existePedidoAmizadeRecebi($value['id'])){
								?>
								<?php }else{?>
									<p><a href="<?php echo INCLUDE_PATH ?>comunidade?aceitarAmizade=<?php echo $value['id'] ?>">Aceitar Pedido</a></p>
								<?php }?>
									<p><a href="<?php echo INCLUDE_PATH ?>comunidade?removerPedidoAmizade=<?php echo $value['id'] ?>" style="color:red">Cancelar Pedido</a></p>
								<?php } ?>

							</div>
							</div>
						</div>
						<?php } ?>
					</div>
			</div>
			</div>
		</div><!--feed-->
	</section>

</body>


</html>