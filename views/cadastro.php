<?php 
    if (isset($_GET['msg']) == 'existe') :
?>
    <div class='alert alert-warning' role='alert'>Este email ja esta cadastrado em nosso sistema!</div>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
<?php
    endif;
?>
<div class="jumbotron m-5 py-2">
    <h2 class="display-4 text-center">Cadastro</h2>
    <hr class="mx-4">
    <form action="<?php echo BASE_URL; ?>cadastro" method="POST" class="form row">
        <div class="form-group col-md-6 my-lg-3">
            <label for="nome" class="lead">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <div class="form-group col-md-6 my-lg-3">
            <label for="email" class="lead">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-group col-md-6 my-lg-3">
            <label for="nome" class="lead">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control">
        </div>
        <div class="form-group col-md-6 my-lg-3">
            <label for="nome" class="lead">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control">
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-primary btn-block w-25 m-auto my-lg-3">
    </form>
</div>
