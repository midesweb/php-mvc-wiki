<div class="contenedor">
    <?php
        echo "<h2>";
        echo "Título: " . $this->detalleTermino->titulo;
        echo "</h2>";
        echo "<p>Categoría: {$this->detalleTermino->categoria}</p>";
        echo "<p>" . nl2br($this->detalleTermino->cuerpo). "</p>";
        echo "<p>Última actualización: " . Fechas::fecha_corta_espanol($this->detalleTermino->actualizacion);
    ?>
<p><a href="<?=URL?>termino/editar/<?=$this->detalleTermino->id_termino?>">Editar este término</a></p>
<p><a href="<?=URL?>termino">Volver</a></p>
</div>