<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style.css">

    <title>Classificados</title>
</head>
<body>
    <header class="mb-2">
        <nav class="nav navbar bg-dark">
            <div class="container-fluid text-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Classificados</a>
                </div>
                <ul class="nav">
                    <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])) : 
                        $logado = $_SESSION['logado'];    
                    ?>
                        <li class="nav-item"><a class="nav-link d-flex" href="<?php echo BASE_URL; ?>perfil"><img  class="m-0" src="<?php echo BASE_URL; ?>assets/images/icons/user.ico" alt="user_icon"><span class="px-2"><?php echo $logado['nome'] ?></span></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>anuncio">Meus Anúncios</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>sair">Sair</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>cadastro">Cadastre-se</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>