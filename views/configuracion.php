<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración - RoqueBet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }

        .header {
            background-color: #0d0d0d;
            border-bottom: 2px solid #ffc107;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .card-custom {
            background-color: #2a2a2a;
            border: 1px solid #ffc107;
            border-radius: 8px;
            margin-bottom: 2rem;
            padding: 1.5rem;
        }

        .card-custom h3 {
            color: #ffc107;
            margin-bottom: 1.5rem;
            font-weight: bold;
            border-bottom: 1px solid #444;
            padding-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            color: #999;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 0.6rem;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus {
            background-color: #1a1a1a;
            color: #fff;
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 193, 7, 0.3);
        }

        .btn-custom {
            background-color: #ffc107;
            color: #000;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #ff9800;
            color: #fff;
        }

        .btn-back {
            background-color: transparent;
            color: #ffc107;
            border: 2px solid #ffc107;
            padding: 0.6rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #ffc107;
            color: #000;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #444;
        }

        .toggle-label {
            color: #999;
        }

        .info-box {
            background-color: #1a1a1a;
            border-left: 4px solid #ff9800;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            color: #ccc;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1 style="color: #ffc107; margin: 0;">⚙️ CONFIGURACIÓN</h1>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Seguridad -->
        <div class="card-custom">
            <h3><i class="fas fa-lock"></i> Seguridad</h3>

            <div class="form-group">
                <label for="password">Cambiar Contraseña</label>
                <input type="password" id="password" placeholder="Nueva contraseña" disabled>
                <small style="color: #999;">Funcionalidad en desarrollo</small>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" placeholder="Confirmar contraseña" disabled>
            </div>

            <button class="btn-custom" disabled>Actualizar Contraseña</button>
        </div>

        <!-- Preferencias -->
        <div class="card-custom">
            <h3><i class="fas fa-sliders-h"></i> Preferencias</h3>

            <div class="toggle-switch">
                <span class="toggle-label">Notificaciones por Email</span>
                <input type="checkbox" checked>
            </div>

            <div class="toggle-switch">
                <span class="toggle-label">Notificaciones Push</span>
                <input type="checkbox">
            </div>

            <div class="toggle-switch">
                <span class="toggle-label">Recordar Sesión</span>
                <input type="checkbox" checked>
            </div>
        </div>

        <!-- Información de Cuenta -->
        <div class="card-custom">
            <h3><i class="fas fa-info-circle"></i> Información de Cuenta</h3>

            <div class="info-box">
                <strong>Identificador de Cuenta:</strong> ID#<?php echo rand(100000, 999999); ?>
            </div>

            <div class="info-box">
                <strong>Última Sesión:</strong> Hoy a las <?php echo date('H:i'); ?>
            </div>

            <div class="info-box">
                <strong>Cuenta Creada:</strong> 2026-01-15
            </div>

            <div style="margin-top: 1.5rem;">
                <button class="btn-custom" style="background-color: #d32f2f;">
                    <i class="fas fa-exclamation-triangle"></i> Desactivar Cuenta
                </button>
            </div>
        </div>

        <!-- Volver -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/perfil" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Perfil
            </a>
        </div>
    </div>
</body>
</html>
