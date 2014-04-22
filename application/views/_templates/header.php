<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title><?php echo property_exists($this, "title")? $this->title : "Mi aplicación de Wiki";?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <h1 class="tituloprincipal">Wiki</h1>
    <nav>
        <ul>
        <li><a href="<?php echo URL; ?>">Home</a></li>
        <li><a href="<?php echo URL; ?>login">Login</a></li>
        <li><a href="<?php echo URL; ?>termino">Términos</a></li>
        <li><a href="<?php echo URL; ?>categorias">Categorias</a></li>
        <li><a href="<?php echo URL; ?>dashboard">Página privada</a></li>
        <li><a href="<?php echo URL; ?>normas">Normas</a></li>
        <li><a href="<?php echo URL; ?>contacto">Contacto</a></li>
        <li><a href="<?php echo URL; ?>login/salir">Salir</a></li>
        </ul>
    </nav>
</header>
