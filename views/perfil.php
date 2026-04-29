<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil - RoqueBet</title>
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
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid #444;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #999;
            font-weight: 600;
        }

        .info-value {
            color: #ffc107;
            font-weight: bold;
        }

        .stat-box {
            background-color: #1a1a1a;
            border-left: 4px solid #ff9800;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            color: #ffc107;
            font-weight: bold;
        }

        .stat-label {
            color: #999;
            font-size: 0.9rem;
            margin-top: 0.5rem;
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
            text-decoration: none;
            display: inline-block;
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

        .btn-logout {
            background-color: #d32f2f;
            margin-left: 0.5rem;
        }

        .btn-logout:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1 style="color: #ffc107; margin: 0;">★ MI PERFIL ★</h1>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Información Personal -->
        <div class="card-custom">
            <h3><i class="fas fa-user"></i> Información Personal</h3>
            <div class="info-row">
                <span class="info-label">Nombre de Usuario:</span>
                <span class="info-value"><?php echo htmlspecialchars($_SESSION['user_nombre'] ?? 'N/A'); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Saldo Actual:</span>
                <span class="info-value">S/ <?php echo number_format($_SESSION['user_saldo'] ?? 0, 2); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Estado de Cuenta:</span>
                <span class="info-value"><i class="fas fa-check-circle" style="color: #00ff00;"></i> Activa</span>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="card-custom">
            <h3><i class="fas fa-chart-bar"></i> Estadísticas</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Apuestas Realizadas</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Victorias</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="stat-number">0%</div>
                        <div class="stat-label">Tasa de Ganancia</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="card-custom">
            <h3><i class="fas fa-cog"></i> Acciones</h3>
            <a href="/configuracion" class="btn-custom">
                <i class="fas fa-sliders-h"></i> Configuración
            </a>
            <a href="/logout" class="btn-custom btn-logout">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>

        <!-- Volver -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/dashboard" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</body>
</html>
