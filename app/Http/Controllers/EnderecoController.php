<?php

namespace App\Http\Controllers;
use App\Models\Endereco;
use App\Models\Pessoa;
use Inertia\Inertia;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{
      public function store(Request $request, Pessoa $pessoa)
      {
          $request->validate([
              'pessoa_id' => 'required|exists:pessoas,id',
              'tipo' => 'required|in:Residencial,Comercial',
              'cep' => 'required|string',
              'logradouro' => 'required|string',
              'numero' => 'required|string',
              'complemento' => 'nullable|string',
              'bairro' => 'required|string',
              'estado' => 'required|string',
              'cidade' => 'required|string',
          ]);
          
          Endereco::create($request->all());

          return redirect()->route('pessoas.show', $pessoa);
      }

      public function edit(Endereco $endereco)
      {
          return Inertia::render('Enderecos/Edit', [
              'endereco' => $endereco
          ]);
      }

      public function update(Request $request, Endereco $endereco)
      {
          $request->validate([
              'tipo' => 'required|in:Residencial,Comercial',
              'cep' => 'required|string',
              'logradouro' => 'required|string',
              'numero' => 'required|string',
              'complemento' => 'nullable|string',
              'bairro' => 'required|string',
              'estado' => 'required|string',
              'cidade' => 'required|string',
          ]);

          $endereco->update($request->all());

          return redirect()->route('pessoas.show', $endereco->pessoa_id);
      }

      public function create(Pessoa $pessoa)
        {
            return Inertia::render('Enderecos/Create', [
                'pessoa' => $pessoa
            ]);
        }

        public function index()
        {
            $enderecos = Endereco::all();
            return Inertia::render('Endereco/Index', [
                'enderecos' => $enderecos
            ]);
        }

        public function destroy(Endereco $endereco)
        {
            $endereco->delete();
            $pessoa = Pessoa::find($endereco->pessoa_id)->load('enderecos');

            return Inertia::render('Pessoas/Show', [
             'pessoa' => $pessoa->load('enderecos')
         ]);    
        }
}
