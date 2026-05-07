<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Citas Médicas</title>
    
    <!-- Bootstrap 5 CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    body {
        background-color: #f5f9fc;
        padding-bottom: 60px;
    }

    /* Navbar estilo app médica */
    .navbar {
        background: linear-gradient(135deg, #0d6efd, #0dcaf0) !important;
        min-height: 85px;
        padding: 0 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        margin-bottom: 30px;
    }

    .navbar-brand {
        font-size: 1.4rem;
        font-weight: 700;
        letter-spacing: .5px;
    }

    .navbar-brand i {
        font-size: 1.6rem;
        margin-right: 8px;
    }

    .navbar-nav {
        margin-left: auto;
        gap: 15px;
    }

    .nav-link {
        color: white !important;
        font-weight: 500;
        padding: 10px 18px !important;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background-color: rgba(255,255,255,0.18);
        transform: translateY(-2px);
    }

    .nav-link i {
        margin-right: 8px;
    }

    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 20px;
    }

    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #f8f9fa;
        text-align: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0,0,0,0.05);
        z-index: 1000;
    }

    .content-wrapper {
        margin-bottom: 80px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .btn-group {
        gap: 5px;
    }
</style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=cita&action=index">
                <i class="fas fa-hospital-user"></i> Sistema Médico
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=cita&action=index">
                            <i class="fas fa-calendar-check"></i> Citas del Día
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=factura&action=index">
                            <i class="fas fa-file-invoice"></i> Facturas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=factura&action=create">
                            <i class="fas fa-plus-circle"></i> Nueva Factura
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content-wrapper mt-4">

    <div class="container mt-4">