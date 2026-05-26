<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f4f7fb, #eef2f9);
            min-height: 100vh;
            color: #1f2937;
        }
        .main-card {
            background: rgba(255,255,255,0.95);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            animation: fadeIn 0.5s ease;
        }
        .btn-modern {
            border: none;
            border-radius: 14px;
            padding: 10px 18px;
            font-weight: 500;
            transition: all .3s ease;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
        }
        .btn-dashboard {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .btn-dashboard:hover {
            color: white;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
        }
        .table tbody tr {
            transition: all .25s ease;
        }
        .table tbody tr:hover {
            transform: scale(1.01);
            background-color: #f8fbff;
        }
        .animated-alert {
            animation: slideDown .4s ease;
        }
        .card-animate {
            animation: zoomIn .4s ease;
        }
        .form-control, .form-select {
            border-radius: 14px;
            padding: 12px;
        }
        @keyframes fadeIn {
            from {opacity:0; transform: translateY(20px);} 
            to {opacity:1; transform: translateY(0);} 
        }
        @keyframes slideDown {
            from {opacity:0; transform: translateY(-10px);} 
            to {opacity:1; transform: translateY(0);} 
        }
        @keyframes zoomIn {
            from {opacity:0; transform: scale(.95);} 
            to {opacity:1; transform: scale(1);} 
        }
    </style>
</head>
<body>
<div class="container py-5">
    @yield('content')
</div>
</body>
</html>
