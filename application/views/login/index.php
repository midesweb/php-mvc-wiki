<div class="contenedor">
    <h2>Login de usuarios</h2>
    <?php
    //d($this);
    //d($_SESSION);
    if(property_exists($this, "error_login")){
        echo "<div class=\"error\">{$this->error_login}</div>";
    }
    ?>
    <form action="<?=URL?>login/dologin" method="post" class="login">
        <section>
            <label>Email:</label> <input type="text" name="email">
            <br />
            <label>Clave:</label> <input type="password" name="clave">
            <br />
            <label>Recordarme:</label> <input type="checkbox" name="recordarme" value="1">
            <br />
            <label>&nbsp;</label> <input type="submit" value="Acceder">
        </section>
    </form>
</div>