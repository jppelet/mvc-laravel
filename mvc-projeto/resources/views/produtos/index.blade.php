<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Produtos</title>
    <style>
        body.dark { background-color: #333; color: #fff; }
        body.dark input, body.dark textarea { background-color: #555; color: #fff; border: 1px solid #777; }
        img { max-width: 120px; display: block; margin: 5px 0; }
        .actions { display: flex; gap: 10px; align-items: center; }
    </style>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body class="{{ $tema == 'dark' ? 'dark' : '' }}">
    <header>
        <h1>Gestão de Produtos</h1>
        <a href="/tema"><button>Alternar Modo Escuro</button></a>
        <a href="/categorias"><button>Ir para Categorias</button></a>
    </header>

    <h2>Novo Produto</h2>

    @if(session('success'))
        <p style="color:green; border:1px solid green; padding:8px;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/produtos" enctype="multipart/form-data">
        @csrf
        <label>Nome do Produto</label>
        <input type="text" name="nome" value="{{ old('nome') }}" required>

        <label>Preço</label>
        <input type="number" name="preco" step="0.01" value="{{ old('preco') }}" required>

        <label>Foto (PNG/JPG)</label>
        <input type="file" name="foto" accept="image/png,image/jpeg" required>

        <button type="submit">Salvar Produto</button>
    </form>

    <hr>

    <h2>Lista de Produtos</h2>
    <table border="1" width="100%" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $p)
                <tr>
                    <td>
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}" alt="Foto">
                        @else
                            Sem foto
                        @endif
                    </td>
                    <td>{{ $p->nome }}</td>
                    <td>R$ {{ number_format($p->preco, 2, ',', '.') }}</td>
                    <td class="actions">
                        <a href="/produtos/{{ $p->id }}/edit">Editar</a>
                        <form method="POST" action="/produtos/{{ $p->id }}" onsubmit="return confirm('Tem certeza que deseja excluir?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:red;color:white;border:none;padding:6px 8px;cursor:pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Nenhum produto cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
