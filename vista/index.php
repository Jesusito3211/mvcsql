<?php require "vista/layouts/header.php"; ?>

<a href="index.php?m=nuevo">NUEVO</a>

<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Id</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Acción</th>
  </tr>

  <?php if (!empty($data) && is_array($data)): ?>
      <?php foreach ($data as $fila): ?>
        <tr>
          <td><?php echo (int)$fila['id']; ?></td>
          <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
          <td>S/. <?php echo number_format((float)$fila['precio'], 2); ?></td>
          <td>
            <a href="index.php?m=editar&id=<?php echo (int)$fila['id']; ?>">EDITAR</a> |
            <a href="index.php?m=eliminar&id=<?php echo (int)$fila['id']; ?>" onclick="return confirm('¿Eliminar producto?');">ELIMINAR</a>
          </td>
        </tr>
      <?php endforeach; ?>
  <?php else: ?>
      <tr>
        <td colspan="4" style="text-align:center">Sin datos para mostrar</td>
      </tr>
  <?php endif; ?>
</table>

<?php require "vista/layouts/footer.php"; ?>
