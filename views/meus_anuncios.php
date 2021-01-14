<?php 
    if(empty($_SESSION['logado'])) {
        echo "<script>window.location.href=".BASE_URL."</script>";
        exit;
    }
    $user_id = $_SESSION['logado'];
    $user_id = $user_id['id'];
    $alerta = isset($alerta) ? $alerta : null;
    if($alerta == 'deletado') {
        echo "<div class='alert alert-success w-50 text-center m-auto' role='alert'>Anúncio APAGADO com sucesso!</div>";
    }elseif($alerta == 'anunciado'){
        echo "<div class='alert alert-success w-50 text-center m-auto' role='alert'>Anúncio ADICIONADO com sucesso!</div>";
    }elseif($alerta == 'editado'){
        echo "<div class='alert alert-success w-50 text-center m-auto' role='alert'>Anúncio EDITADO com sucesso!</div>";
    }
?>
<script>
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);
</script>
<div class="container my-2">
    <h1>Meus Anúncios</h1>
    <a class="btn btn-primary my-2" href="<?php echo BASE_URL; ?>anuncio/add/<?php echo $user_id; ?>">Adicionar Anúncio</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Título</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($anuncios as $anuncio) : ?>
                <tr>
                    <?php if($anuncio['url_img'] == ''){
                        echo "<td><img src='".BASE_URL."assets/images/anuncios/anuncio.png' alt='Imagem do anúncio'></td>";
                    }else {
                        echo "<td><img src='".BASE_URL."assets/images/anuncios/".$anuncio['url_img']."' alt='Imagem do anúncio'></td>";
                    } ?>
                    <td><?php echo $anuncio['titulo']; ?></td>
                    <td><?php echo number_format($anuncio['valor'], 2); ?></td>
                    <td><a href="<?php echo BASE_URL; ?>anuncio/edit/<?php echo $anuncio['id']; ?>/<?php echo $user_id; ?>" class="btn btn-success m-1">EDITAR</a><a href="<?php echo BASE_URL; ?>anuncio/delete/<?php echo $anuncio['id']; ?>" class="btn btn-danger m-1">EXCLUIR</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>