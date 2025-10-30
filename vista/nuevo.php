<?php require "layouts/header.php"; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Añadir Nuevo Producto</h2>
        </div>
        <div class="card-body">
            <form action="index.php?m=guardar" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">S/.</span>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" placeholder="0.00" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="index.php" class="btn btn-secondary me-2">
                        <i class="fas fa-times me-1"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "layouts/footer.php"; ?>
