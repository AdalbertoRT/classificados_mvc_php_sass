<section class="container-fluid">
    <div class="jumbotron container my-2 py-4">
        <h2 class="display-4">Nós temos hoje <?php echo $qtd_anuncios; ?> anuncios!</h2>
        <p class="lead">Estão cadastrados <?php echo $qtd_usuarios; ?> usuários.</p>
    </div>
    <div class="row container m-auto p-0">
        <div class="col-sm-3 p-0">
            <h4>Pesquisa Avançada</h4>
            <form method="get" class="form pr-2">
                <div class="form-group">
                    <label for="categorias" class="lead">Categoria: </label>
                    <select name="filtros[categoria]" id="categorias" class="form-control">
                        <option value="" <?php echo ($filtros['categoria'] == '')?'selected="selected"':''; ?>>- Todas -</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat['id'] ?>" <?php echo ($filtros['categoria'] == $cat['id'])?'selected="selected"':''; ?>><?php echo $cat['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="preco" class="lead">Preço: </label>
                    <div class="d-flex">
                        <?php $preco = explode('-', $filtros['preco']); ?>
                        <input type="number" id="precoi" class="form-control" min="0" step="50" value="<?php echo ($preco[0] == '')?'':$preco[0]; ?>">
                        <span class="p-1">até</span>
                        
                        <input type="number" id="precof" class="form-control" min="0" step="50"  value="<?php echo ($preco[1] == '')?'':$preco[1]; ?>">
                        
                        <input type="hidden" name="filtros[preco]" id='precos' value="">
                        <script>
                            function preco(){
                                let precoi = document.getElementById('precoi').value;
                                let precof = document.getElementById('precof').value;
                                
                                if(precoi > precof && precoi != 0 && precof != ''){
                                    let menor = precof;
                                    precof = precoi;
                                    precoi = menor;
                                    if(precoi == ''){
                                    precoi = 0;
                                }
                                }
                                if(precoi == precof && precoi != 0){
                                    precoi = 0;
                                }
                                
                                let precos = precoi.toString() + '-' + precof.toString();
                                let elemento = document.getElementById('precos');
                                elemento.value = precos;
                            }
                        </script>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="estado" class="lead">Estado: </label><br> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filtros[estado]" id="qualquer" value="" <?php echo ($filtros['estado'] == '')?'checked="checked"':''; ?>>
                        <label class="form-check-label mr-3" for="qualquer">Qualquer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filtros[estado]" id="usado" value="usado" <?php echo ($filtros['estado'] == 'usado')?'checked="checked"':''; ?>>
                        <label class="form-check-label mr-3" for="usado">Usado</label>
                        <input class="form-check-input" type="radio" name="filtros[estado]" id="seminovo" value="seminovo" <?php echo ($filtros['estado'] == 'seminovo')?'checked="checked"':''; ?>>
                        <label class="form-check-label mr-3" for="seminovo">Seminovo</label>
                        <input class="form-check-input" type="radio" name="filtros[estado]" id="novo" value="novo" <?php echo ($filtros['estado'] == 'novo')?'checked="checked"':''; ?>>
                        <label class="form-check-label" for="novo">Novo</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Buscar" class="btn btn-primary" onclick="preco()">
                </div>
            </form>
        </div>
        <div class="col-sm-9 p-0">
            <h4>Últimos Anúncios</h4>
            <table class="table table-striped">
                <?php foreach($ultimos_anuncios as $ua) : ?>
                    <?php $foto = !empty($ua['url_img']) ? BASE_URL.'assets/images/anuncios/'.$ua['url_img'] : BASE_URL.'assets/images/anuncios/anuncio.png'  ?>
                    <tr>
                        <td><a href="item/index/<?php echo $ua['id'] ?>"><img src="<?php echo $foto ?>" alt="Imagem do Anúncio"></a></td>
                        <td><a href="item/index/<?php echo $ua['id'] ?>"><?php echo $ua['titulo']; ?></a><br><span class="small"><?php echo $ua['cat']; ?></span></td>
                        <td><?php echo 'R$'.$ua['valor']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <ul class="pagination">
            <?php $url = $_SESSION['filtros'];?>
                <li class="page-item <?php echo (($p-1)<=0)?'disabled':''; ?>"><a class="page-link prev py-0 mx-1 border border-primary" href="<?php echo BASE_URL.'home/index/'.($p-1).$url; ?>"><span>&#8678;</span></a></li>
                <?php for($q=1; $q<=$paginas; $q++): ?>
                <li class="page-item <?php echo ($p==$q) ? 'active' : '' ?>"><a class="page-link" href="<?php echo BASE_URL; ?>home/index/<?php echo $q.$url; ?>"><?php echo $q; ?></a></li>
                <?php endfor; ?>
                 <li class="page-item <?php echo (($p+1)>$paginas)?'disabled':''; ?>"><a class="page-link next py-0 mx-1 border border-primary" href="<?php echo BASE_URL.'home/index/'.($p+1).$url; ?>"><span>&#8680;</span></a></li>
            </ul>
        </div>
    </div>
</section>
