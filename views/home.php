<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoqueBet - Apuestas Deportivas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1a1a1a;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #0d0d0d;
            border-bottom: 2px solid #ffc107;
            padding: 1.5rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffc107;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 76vh;
            background-color: #1a1a1a;
            text-align: center;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: bold;
            color: #ffc107;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: #cccccc;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .btn-custom {
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0.5rem;
        }

        .btn-primary-custom {
            background-color: #ffc107;
            color: #000;
            border: 2px solid #ffc107;
        }

        .btn-primary-custom:hover {
            background-color: #ff9800;
            border-color: #ff9800;
            color: #fff;
        }

        .btn-secondary-custom {
            background-color: transparent;
            color: #ffc107;
            border: 2px solid #ffc107;
        }

        .btn-secondary-custom:hover {
            background-color: #ffc107;
            color: #000;
        }

        .features {
            background-color: #0d0d0d;
            padding: 4rem 0;
            border-top: 2px solid #ffc107;
            border-bottom: 2px solid #ffc107;
        }

        .features h2 {
            text-align: center;
            font-size: 2rem;
            color: #ffc107;
            margin-bottom: 3rem;
            font-weight: bold;
        }

        .feature-box {
            background-color: #1a1a1a;
            border-left: 4px solid #ff9800;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .feature-box h3 {
            color: #ff9800;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .feature-box p {
            color: #999;
            font-size: 0.95rem;
        }

        footer {
            background-color: #0d0d0d;
            padding:1rem;
            text-align: center;
            border-top: 2px solid #ffc107;
            color: #999;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .btn-custom {
                display: block;
                margin-bottom: 1rem;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">★ ROQUEBET ★</div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenido a RoqueBet</h1>
            <p>Apuestas deportivas rápidas, seguras y emocionantes</p>
            <div>
                <a href="/register" class="btn-custom btn-primary-custom">Registrarse</a>
                <a href="/login" class="btn-custom btn-secondary-custom">Iniciar Sesión</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 RoqueBet. Todos los derechos reservados.</p>
    </footer>
</body>
</html>