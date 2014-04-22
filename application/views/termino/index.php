<div class="contenedor">
    <h1>Todos los términos</h1>
    <?php
    if(isset($this->terminos)){
        echo '<div id="resultterminos">';
        echo "<ol>";
    
        foreach($this->terminos as $term){
            ?>
            <li>
                <a href="<?=URL?>termino/ver/<?=$term->id_termino?>"><?=$term->titulo?></a>
            </li>
            <?php
        }
        
        echo "</ol>";
        echo "</div>";
    }
    ?>
            
    <section>
        <form action="<?=URL?>termino/buscarnormal" method="post">
            Buscar término:<br />
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
        </form>
    </section>
    <br />
    <section>
        <form>
            Buscar con Ajax término:<br />
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar" id="buscadorajax">
        </form>
    </section>
    <br />
    <section>
        <form>
            Buscar con Ajax término JSON:<br />
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar" id="buscadorajaxjson">
        </form>
    </section>
    
    <ul id="sortable">
    </ul>
    
    <p><a href="<?=URL?>termino/crear">Crear término</a></p>
</div>

<script type="text/x-handlebars-template" id="template">
<div id="terminoslista">
<ul>
{{# each terminos}}
    <li>
        Término: <b>{{titulo}}</b>
        <br />
        <i><a href="<?=URL?>termino/ver/{{id_termino}}">Ver este término</a></i>
    </li>
{{/each}}
</ul>
</div>
</script>

<script type="text/x-handlebars-template" id="template2">
<div id="intercambiador">
<ul>
{{# each terminos}}
    <li>
        Término:
        <br />
        {{titulo}}
        <br />
        <a href="<?=URL?>termino/ver/{{id_termino}}">Ver este término</a>
    </li>
{{/each}}
</ul>
</div>
</script>