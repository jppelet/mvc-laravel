<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 40px auto; padding: 20px; }
        nav { background: #333; padding: 15px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; }
        .alert { padding: 10px; margin: 15px 0; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
        form { background: #f5f5f5; padding: 20px; margin-bottom: 30px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; }
        button { background: #333; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #333; color: white; }
    </style>
</head>
<body>
    <nav>
        <a href="/categorias">Categorias</a>
        <a href="/produtos">Produtos</a>
    </nav>
    
    @yield('content')
</body>
</html>