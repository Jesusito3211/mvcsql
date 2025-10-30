<?php require "vista/layouts/header.php"; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Gestión de Productos</h2>
            <a href="index.php?m=nuevo" class="btn btn-light btn-sm">
                <i class="fas fa-plus-circle me-2"></i>Añadir Nuevo Producto
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data) && is_array($data)): ?>
                            <?php foreach ($data as $fila): ?>
                                <tr>
                                    <th scope="row"><?php echo (int)$fila['id']; ?></th>
                                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                    <td>S/. <?php echo number_format((float)$fila['precio'], 2); ?></td>
                                    <td class="text-center">
                                        <a href="index.php?m=editar&id=<?php echo (int)$fila['id']; ?>" class="btn btn-outline-warning btn-sm me-2">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <a href="index.php?m=eliminar&id=<?php echo (int)$fila['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este producto?');">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">No hay productos para mostrar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require "vista/layouts/footer.php"; ?>
