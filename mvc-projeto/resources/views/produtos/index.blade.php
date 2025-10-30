@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <h1>Produtos</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form action="/produtos" method="POST">
        @csrf
        <h3>Novo Produto</h3>
        
        <label>Nome:</label>
        <input type="text" name="nome" required>
        @error('nome')<span style="color:red;">{{ $message }}</span>@enderror
        
        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required>
        @error('preco')<span style="color:red;">{{ $message }}</span>@enderror
        
        <label>Categoria:</label>
        <select name="categoria_id" required>
            <option value="">Selecione</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
            @endforeach
        </select>
        @error('categoria_id')<span style="color:red;">{{ $message }}</span>@enderror
        
        <button type="submit">Cadastrar</button>
    </form>
    
    <h3>Lista de Produtos</h3>
    @if($produtos->count() > 0)
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
            @foreach($produtos as $prod)
            <tr>
                <td>{{ $prod->id }}</td>
                <td>{{ $prod->nome }}</td>
                <td>R$ {{ number_format($prod->preco, 2, ',', '.') }}</td>
                <td>{{ $prod->categoria->nome }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Nenhum produto cadastrado.</p>
    @endif
@endsection