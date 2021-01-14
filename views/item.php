<div class="container">
    <div class="row item">
        <div class="col-sm-5">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php foreach($imagens as $chave => $img): ?>
                    <div class="carousel-item <?php echo ($chave=='0') ? 'active' : ''; ?>">
                        <img src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $img['url_img']; ?>" class="d-block" alt="Anuncio <?php echo $chave; ?>">
                    </div>
                <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded shadow" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded shadow" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-7">
            <h1><?php echo $info['titulo']; ?></h1>
            <h6>Categoria: <?php echo $info['categoria']; ?></h3>
            <h5 class="py-3"><?php echo $info['descricao']; ?></h1>
            <h1 class="pb-3"><?php echo 'R$'.$info['valor']; ?></h1>
            <h5>Anunciante: <?php echo $info['anunciante']; ?></h4>
            <h5>Telefone: <?php echo $info['telefone']; ?></h4>
            
        </div>
    </div>
</div>