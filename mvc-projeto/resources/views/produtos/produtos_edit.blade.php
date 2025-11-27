<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
    <h1>Editar Produto</h1>
    <a href="/produtos">Voltar</a>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/produtos/{{ $produto->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required>

        <label>Preço</label>
        <input type="number" step="0.01" name="preco" value="{{ old('preco', $produto->preco) }}" required>

        <label>Trocar Foto (opcional)</label>
        <input type="file" name="foto" accept="image/png,image/jpeg">

        @if($produto->foto)
            <p>Foto atual:</p>
            <img src="{{ asset('storage/'.$produto->foto) }}" width="140">
        @endif

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
