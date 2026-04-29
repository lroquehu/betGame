<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RoqueBet - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .ranking-card {
            background-color: #1a1a1a;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 1rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .ranking-title {
            color: #ffc107;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 1.2rem;
        }

        .ranking-item {
            display: flex;
            justify-content: space-between;
            padding: 0.7rem;
            border-bottom: 1px solid #333;
            font-size: 0.9rem;
        }

        .ranking-item:last-child {
            border-bottom: none;
        }

        .ranking-position {
            color: #ffc107;
            font-weight: bold;
            min-width: 30px;
        }

        .ranking-name {
            color: #ccc;
            flex: 1;
            margin-left: 1rem;
        }

        .ranking-saldo {
            color: #00ff00;
            font-weight: bold;
        }

        .frequency-card {
            background-color: #1a1a1a;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 1rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .frequency-title {
            color: #ffc107;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 1.2rem;
        }

        .frequency-row {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .frequency-item {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
            border: 2px solid white;
        }

        .frequency-local {
            background-color: #ff3131;
        }

        .frequency-visitante {
            background-color: #008cff;
        }

        .frequency-empate {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container-fluid py-4">
        <!-- Sección Principal del Juego -->
        <div class="row g-0 align-items-stretch justify-content-center bg-black-bet rounded-4 border border-warning shadow-lg overflow-hidden position-relative mb-4">
            <div class="col-lg-3 d-none d-lg-block">
                <img src="/assets/img/monop.jpg" class="w-100 h-100" style="object-fit: cover; opacity: 0.7;">
            </div>

            <div class="col-lg-6 col-md-10 py-4 px-5 border-start border-end border-warning">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h1 class="text-warning fw-bold m-0" style="letter-spacing: 2px; font-size:30px;">★★★ ROQUEBET ★★★</h1>
                </div>

                <div class="roulette-container mb-4 position-relative text-center bg-dark rounded-4 border border-secondary p-4 shadow-inner">
                    <div class="wheel-pointer position-absolute top-0 start-50 translate-middle-x text-warning" style="z-index:20; font-size: 2.5rem; filter: drop-shadow(0 0 10px gold);">▼</div>

                    <div id="roulette-wheel" class="mx-auto rounded-circle border border-white shadow-gold" style="width: 180px; height: 180px; transition: transform 3s cubic-bezier(0.15, 0, 0.15, 1); position: relative;">
                    </div>

                    <div id="contador" class="display-1 fw-bold text-white position-absolute top-50 start-50 translate-middle" style="z-index: 30; text-shadow: 0 0 20px #000;" hidden>3</div>

                    <h3 id="resultado" class="mt-3 fw-bold text-uppercase tracking-widest text-white" style="min-height: 1.5em;"></h3>
                </div>

                <div class="bet-container mb-4">
                    <button id="local" class="btn-main-bet btn-local-style shadow-red" disabled onclick="seleccionarEquipo('LOCAL')">LOCAL</button>
                    <button id="empate" class="btn-empate-center shadow-gold" disabled onclick="seleccionarEquipo('EMPATE')">EMPATE</button>
                    <button id="visitante" class="btn-main-bet btn-visitante-style shadow-blue" disabled onclick="seleccionarEquipo('VISITANTE')">VISITANTE</button>
                </div>

                <div class="p-3 rounded-3 bg-black border border-secondary d-flex align-items-center justify-content-between gap-3">
                    <div class="saldo-display border border-warning px-3 py-1 rounded-pill text-warning fw-bold" style="white-space: nowrap;">
                        S/ <span id="user-saldo"><?php echo number_format($_SESSION['user_saldo'] ?? 0, 2); ?></span>
                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2">
                        <?php foreach([2.5, 5, 10, 25, 125, 500] as $m): ?>
                            <button class="btn-amount-outline" onclick="recargarMonto(<?php echo $m; ?>)"><?php echo $m; ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-none d-lg-block position-relative bg-dark-custom">
                <img src="/assets/img/monopoly.jpg" class="w-100 h-100" style="object-fit: cover; opacity: 0.6;">

                <div class="buttons-container-bottom">
                    <a href="/perfil" class="btn-sidebar-icon" title="Perfil">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="/configuracion" class="btn-sidebar-icon" title="Configuración">
                        <i class="fas fa-cog"></i>
                    </a>
                    <a href="/logout" class="btn-sidebar-icon btn-logout-icon" title="Cerrar Sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Ranking y Frecuencia -->
        <div class="row g-3">
            <!-- Ranking -->
            <div class="col-lg-6">
                <div class="ranking-card">
                    <div class="ranking-title">TOP JUGADORES</div>
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $userModel = new User($db);
                    $ranking = $userModel->getRanking();

                    if (!empty($ranking)):
                        foreach ($ranking as $index => $player):
                    ?>
                    <div class="ranking-item">
                        <span class="ranking-position">#<?php echo $index + 1; ?></span>
                        <span class="ranking-name"><?php echo htmlspecialchars($player['nombre']); ?></span>
                        <span class="ranking-saldo">S/ <?php echo number_format($player['saldo'], 2); ?></span>
                    </div>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <div style="text-align: center; color: #999; padding: 2rem;">
                        Sin datos disponibles
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Frecuencia de Colores -->
            <div class="col-lg-6">
                <div class="frequency-card">
                    <div class="frequency-title">ÚLTIMOS RESULTADOS</div>
                    <div class="frequency-row" id="frequency-container">
                        <span style="color: #999; text-align: center; width: 100%; padding: 2rem;">Esperando resultados...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
</body>
</html>