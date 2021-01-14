<?php 
    $alerta = isset($_GET['msg']) ?  $_GET['msg'] : null;
    if($alerta == "invalido") :
?>
    <div class='alert alert-warning m-1' role='alert'>Login inválido! Tente novamente.</div>
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

<div class="p-5">
    <div class="jumbotron m-auto py-2 w-50">
        <h2 class="display-4 text-center">Login</h2>
        <hr class="mx-4">
        <form action="<?php echo BASE_URL; ?>login" method="POST" class="form">
            <div class="form-group  my-lg-3">
                <label for="email" class="lead">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group  my-lg-3">
                <label for="nome" class="lead">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control">
            </div>
            <input type="submit" value="Entrar" class="btn btn-primary btn-block w-25 m-auto my-lg-3">
        </form>
    </div>
</div>
