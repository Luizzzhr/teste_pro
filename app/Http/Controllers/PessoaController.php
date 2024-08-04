<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;

use Illuminate\Http\Request;

use Inertia\Inertia;


class PessoaController extends Controller
{
     public function index()
     {
         $pessoas = Pessoa::all();
         return Inertia::render('Pessoas/Index', [
             'pessoas' => $pessoas
         ]);
     }

     public function create()
     {
         return Inertia::render('Pessoas/Create');
     }

     public function store(Request $request)
     {
         $request->validate([
             'nome' => 'required|string',
             'nome_social' => 'nullable|string',
             'cpf' => 'required|string|unique:pessoas',
             'nome_pai' => 'nullable|string',
             'nome_mae' => 'nullable|string',
             'telefone' => 'nullable|string',
             'email' => 'nullable|email',
         ]);

         Pessoa::create($request->all());

         return redirect()->route('pessoas.index');
     }

     public function show(Pessoa $pessoa)
     {
        $pessoa = Pessoa::with(['enderecos' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($pessoa->id);

        return Inertia::render('Pessoas/Show', [
            'pessoa' => $pessoa
        ]);
     }

     public function edit(Pessoa $pessoa)
     {
         return Inertia::render('Pessoas/Edit', [
             'pessoa' => $pessoa
         ]);
     }

     public function update(Request $request, Pessoa $pessoa)
     {
         $request->validate([
             'nome' => 'required|string',
             'nome_social' => 'nullable|string',
             'cpf' => 'required|string|unique:pessoas,cpf,' . $pessoa->id,
             'nome_pai' => 'nullable|string',
             'nome_mae' => 'nullable|string',
             'telefone' => 'nullable|string',
             'email' => 'nullable|email',
         ]);

         $pessoa->update($request->all());

         return redirect()->route('pessoas.index');
     }

     public function destroy(Pessoa $pessoa)
     {
         $pessoa->delete();

         return redirect()->route('pessoas.index');
     }
}
