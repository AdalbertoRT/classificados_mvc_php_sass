<div class="container my-3 py-1">
    <h1>Editar Anúncio</h1>
    <hr>
    <?php 
        if(!$_SESSION['logado']) {
            echo "<script>window.location.href = '".BASE_URL."';</script>";
        }

        $alerta = isset($_GET['msg']) ?  $_GET['msg'] : null;
        if($alerta == "anunciou") :
    ?>
        <div class='alert alert-warning m-1' role='alert'>Anúncio EDITADO com sucesso!</div>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
    <?php endif; ?>

    <form class="form" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-3">
            <label for="categoria" class="lead">Categoria: </label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="" class="small text-light" <?php echo ($info['id_categoria'] == '') ? 'selected = "selected"' : ''; ?>>< SELECIONE ></option>
                <?php foreach($categoria as $cat) : ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo ($info['id_categoria'] == $cat['id']) ? 'selected = "selected"' : ''; ?> ><?php echo $cat['nome']; ?></option>;
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="titulo" class="lead">Título: </label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="valor" class="lead">Preço: </label>
            <input type="number" name="valor" id="valor" class="form-control" value="<?php echo $info['valor']; ?>">
        </div>
    </div>
        <div class="form-group">
            <label for="descricao" class="lead">Descrição: </label>
            <textarea name="descricao" id="descricao" class="form-control"><?php echo $info['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="Estado" class="lead">Estado: </label>
            <select name="estado" id="estado" class="form-control">
                <option value="" <?php echo ($info['id'] == '') ? 'selected = "selected"' : ''; ?>>< SELECIONE ></option>
                <option value="0" <?php echo ($info['estado'] == 0) ? 'selected = "selected"' : ''; ?>>USADO</option>
                <option value="1" <?php echo ($info['estado'] == 1) ? 'selected = "selected"' : ''; ?>>SEMINOVO</option>
                <option value="2" <?php echo ($info['estado'] == 2) ? 'selected = "selected"' : ''; ?>>NOVO</option>               
            </select>
        </div>
        <div class="form-group d-flex flex-column">
            <label for="imagem" class="lead">Adicionar imagens: </label>
            <input type="file" multiple name="imagem[]" id="imagem">
        </div>
        
        <div class="card w-100">
            <div class="card-header lead p-1">Imagens do anúncio: </div>
            <div class="card-body py-1 d-flex">
                <?php if(empty($imagens)) : ?>
                    <div class='text-center w-100 card-text'><span>Não há imagens neste anúncio.</span></div>
                <?php else : ?>
                    <?php foreach($imagens as $img) : ?>
                        <div class="img-thumbnail imgs">
                            <img src="<?php echo BASE_URL."assets/images/anuncios/".$img['url_img'] ?>" alt="Imagem do anuncio"><br>
                            <a href="<?php echo BASE_URL ?>anuncio/excluir_img/<?php echo $img['id'] ?>/<?php echo $img['id_anuncio']; ?>" class="btn btn-secondary mt-1 py-0 btn-block">Excluir</a> 
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div> 
        </div>
        <div class="form-group my-2">
            <input type="submit" value="Salvar" class="btn btn-primary btn-block w-25 m-auto">
        </div>
    </form>
</div>