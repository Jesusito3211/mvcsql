<?php require "vista/layouts/header.php"; ?>
<h1>Nuevo Producto</h1>
<form method="post" action="index.php?m=guardar">
    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br>
    <label>Precio:</label><br>
    <input type="text" name="precio"><br>
    <input type="submit" value="Guardar">
</form>
<?php require "vista/layouts/footer.php"; ?>

