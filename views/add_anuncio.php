<div class="container my-3 py-1">
    <h1>Novo Anúncio</h1>
    <hr>

    <?php
        if(isset($_SESSION['logado'])) {
            $user_id = $_SESSION['logado'];
            $user_id = $user_id['id'];
        }else{
            header("Location: ".BASE_URL);
        }
    ?>

    <form action="<?php echo BASE_URL; ?>anuncio/add/<?php echo $user_id; ?>" class="form" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-3">
            <label for="categoria" class="lead">Categoria: </label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="0" class="small text-light">< SELECIONE ></option>
                <?php foreach($categoria as $cat) : ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>";
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="titulo" class="lead">Título: </label>
            <input type="text" name="titulo" id="titulo" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label for="valor" class="lead">Preço: </label>
            <input type="number" name="valor" id="valor" class="form-control">
        </div>
    </div>
        <div class="form-group">
            <label for="descricao" class="lead">Descrição: </label>
            <textarea name="descricao" id="descricao" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="Estado" class="lead">Estado: </label>
            <select name="estado" id="estado" class="form-control">
                <option value="">< SELECIONE ></option>
                <option value="0">USADO</option>
                <option value="1">SEMINOVO</option>
                <option value="2">NOVO</option>               
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Adicionar" class="btn btn-primary btn-block w-25 m-auto">
        </div>
    </form>
</div>