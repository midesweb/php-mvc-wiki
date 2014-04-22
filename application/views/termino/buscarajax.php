    <?php
    if($this->terminos){
        echo "<ol>";
    
        foreach($this->terminos as $term){
            ?>
            <li>
                <a href="<?=URL?>termino/ver/<?=$term->id_termino?>"><?=$term->titulo?></a>
            </li>
            <?php
        }
        
        echo "</ol>";
    }
    ?>