<div class="contenedor">
    <h1>Categorias</h1>
    
    <?php
    $this->renderFeedbackMessages();
    ?>
    
    <div id="listadocategorias"></div>
    <div id="editarcategoria"></div>
    <div id="detallecategoria"></div>
</div>


<script type="text/x-handlebars-template" id="tmpl_listacategoria">
<ol>
{{# each categorias}}
    <li>
        <b>{{categoria}}</b> &nbsp;&nbsp;
        <a class="enlaceexpandir" href="<?=URL?>categorias/expandir/{{id_categoria}}">[Ver terminos de esta categoria]</a>
        <a class="enlaceeditar" href="<?=URL?>categorias/editar/{{id_categoria}}">[Editar esta categoria]</a>
    </li>
{{/each}}
</ol>
</script>

<script type="text/x-handlebars-template" id="tmpl_listaterminos">
<h2>Términos de {{terminos.categoria}}</h2>
<ol>
{{# each terminos.terminos}}
    <li>
        <b>{{titulo}}</b> <a href="<?=URL?>termino/ver/{{id_termino}}">[ Ver terminos de esta categoria ]</a>
    </li>
{{/each}}
</ol>
</script>

<script type="text/x-handlebars-template" id="tmpl_editacategoria">
<h2>Editando {{categoria}}</h2>
<form action="<?=URL?>categorias/salvaredicion" method="post">
    <input type="hidden" name="id_categoria" value="{{id_categoria}}">
    Nombre: <input type="text" name="categoria" value="{{categoria}}">
    <br>
    <input type="submit" value="editar">
    <div class="muestraresultado"></div>
</form>
</script>