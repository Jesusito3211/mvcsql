<?php require "layouts/header.php"; ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4 text-primary">Acceso al Sistema</h3>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-3" id="loginTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Iniciar Sesión</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Registrarse</button>
            </li>
        </ul>

        <div class="tab-content" id="loginTabsContent">
            <!-- 🟢 LOGIN -->
            <div class="tab-pane fade show active" id="login" role="tabpanel">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese su contraseña" required>
                    </div>

                    <input type="hidden" name="m" value="validar">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
            </div>

            <!-- 🟣 REGISTRO -->
            <div class="tab-pane fade" id="register" role="tabpanel">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="correo_nuevo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_nuevo" name="correo" placeholder="Ingrese su correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="clave_nueva" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave_nueva" name="clave" placeholder="Cree una contraseña" required>
                    </div>

                    <input type="hidden" name="m" value="registrar">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "layouts/footer.php"; ?>
