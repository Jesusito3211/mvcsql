<?php require "vista/layouts/header.php"; ?>

<h1>Editar Producto</h1>

<?php
$fila = (isset($data[0]) && is_array($data[0])) ? $data[0] : ['id'=>'','nombre'=>'','precio'=>''];
?>

<form method="post" action="index.php?m=update">
  <label>Nombre:</label><br>
  <input type="text" name="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>"><br>

  <label>Precio:</label><br>
  <input type="text" name="precio" value="<?php echo htmlspecialchars($fila['precio']); ?>"><br>

  <input type="hidden" name="id" value="<?php echo (int)$fila['id']; ?>">
  <input type="submit" value="Actualizar">
</form>

<?php require "vista/layouts/footer.php"; ?>
