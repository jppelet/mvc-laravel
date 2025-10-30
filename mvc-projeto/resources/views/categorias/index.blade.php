@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <h1>Categorias</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form action="/categorias" method="POST">
        @csrf
        <h3>Nova Categoria</h3>
        
        <label>Nome:</label>
        <input type="text" name="nome" required>
        @error('nome')<span style="color:red;">{{ $message }}</span>@enderror
        
        <button type="submit">Cadastrar</button>
    </form>
    
    <h3>Lista de Categorias</h3>
    @if($categorias->count() > 0)
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data</th>
            </tr>
            @foreach($categorias as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->nome }}</td>
                <td>{{ $cat->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Nenhuma categoria cadastrada.</p>
    @endif
@endsection