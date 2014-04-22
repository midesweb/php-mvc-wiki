<div class="contenedor">
    <h2><?=$this->accion?></h2>
    <?php
    $this->renderFeedbackMessages();
    if(isset($this->termino)){
        $term = is_object($this->termino) ? get_object_vars($this->termino) : $this->termino;   
    }
    ?>
    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <section>
        <input type="hidden" name="id_termino" value="<?php if (isset($term["id_termino"])) echo $term["id_termino"];?>">
        Titulo:
        <br />
        <input type="text" name="titulo" size="60" value="<?php if (isset($term["titulo"])) echo $term["titulo"]?>">
        <br />
        Cuerpo:
        <br />
        <textarea style="width: 85%; height: 200px;" name="cuerpo"><?php if (isset($term["cuerpo"])) echo $term["cuerpo"]?></textarea>
        <br /><br />
        Categoria
        <br >
        <select name="id_categoria">
            <?php
            foreach ($this->categorias as $cat){
                echo "<option value=\"{$cat->id_categoria}\"";
                if (isset($term["id_categoria"]) && $term["id_categoria"]==$cat->id_categoria) echo " selected ";
                echo ">{$cat->categoria}</option>";
            }
            ?>
        </select>    
        <br /><br />
        <input type="submit" value="Enviar">
        </section>    
    </form>
</div>