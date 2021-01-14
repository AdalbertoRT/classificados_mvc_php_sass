<!--ALERTAS-->
<?php 
    $alerta = isset($_GET['msg']) ?  $_GET['msg'] : null;
    if($alerta == "cadastrou") :
?>
    <div class='alert alert-success m-1' role='alert'>Cadastro efetuado com sucesso!!!</div>
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

<!--Cabeçalho (HEADER)-->
<?php require "header.php"; ?> 

<!--Conteudo (SECTION)-->
<?php $this->loadView($viewName, $viewData) ?> 

<!--Rodapé (FOOTER)-->
<?php require "footer.php"; ?>