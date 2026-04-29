<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RoqueBet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-dark d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card bg-black border-secondary shadow-lg position-relative text-white">
                    <a href="/" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" aria-label="Close"></a>
                    
                    <div class="card-body p-5">
                        <h2 class="text-center text-warning mb-4 fw-bold">ROQUEBET</h2>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; ?>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; ?>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>
                        
                        <form action="/login" method="POST">
                            <div class="mb-3">
                                <label class="form-label small text-secondary">EMAIL</label>
                                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small text-secondary">CONTRASEÑA</label>
                                <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 fw-bold py-2">ENTRAR</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <a href="/register" class="text-warning text-decoration-none small">¿No tienes cuenta? Regístrate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>