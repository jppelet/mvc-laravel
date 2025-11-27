<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::all();
        $tema = $request->cookie('tema_escuro') ? 'dark' : 'light';
        return view('produtos', compact('produtos', 'tema'));
    }

    // Store (create) com upload
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:2|max:100',
            'preco' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        $dados = $request->only(['nome','preco']);

        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('produtos', 'public');
            $dados['foto'] = $caminho;
        }

        Produto::create($dados);

        return redirect('/produtos')->with('success', 'Produto criado com sucesso!');
    }

   
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos_edit', compact('produto'));
    }


    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|min:2|max:100',
            'preco' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $dados = $request->only(['nome','preco']);

        if ($request->hasFile('foto')) {
            if ($produto->foto) {
                Storage::disk('public')->delete($produto->foto);
            }
            $dados['foto'] = $request->file('foto')->store('produtos', 'public');
        }

        $produto->update($dados);

        return redirect('/produtos')->with('success', 'Produto atualizado!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->foto) {
            Storage::disk('public')->delete($produto->foto);
        }

        $produto->delete();

        return redirect('/produtos')->with('success', 'Produto excluído!');
    }

    public function alternarTema()
    {
        $cookie = Cookie::get('tema_escuro');
        if ($cookie) {
            return redirect()->back()->withCookie(Cookie::forget('tema_escuro'));
        }
        return redirect()->back()->withCookie(cookie('tema_escuro', 'ativo', 60));
    }
}
