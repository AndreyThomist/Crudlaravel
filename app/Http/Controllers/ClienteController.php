<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Exception;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
   public function index()
   {
      $clientes = Cliente::select('id','logradouro','cep','nome','logradouro','data_nascimento','complemento','identidade','telefone')
      ->paginate(10);
      return view('cliente.index',compact('clientes'));
   }

   public function validar($dados)
   {
      return Validator::make(
         $dados,
         [
            'nome' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'complemento' => 'required',
            'data_nascimento' => 'required',
            'identidade' => 'required',
            'telefone' => 'required',
            'cep' => 'regex:/[0-9]{5}-[\d]{3}/',
         ],
         [
            'data_nascimento.required' => 'Campo data de nascimento obrigatório',
            'nome.required' => 'Campo Nome Obrigatório',
            'cep.required' => 'Campo cep obrigatório',
            'logradouro.required' => 'Campo logradouro Obrigatório',
            'complemento.required' => 'Campo complemento Obrigatório',
            'identidade.required' => 'Campo identidade Obrigatório',
            'telefone.required' => 'Campo Nome Obrigatório',
            'cep.regex' => 'Cep inválido',
            'identidade.regex' => 'Identidade inválida'
        ]
      );
   }


   public function store(Request $request)
   {
      $validation = $this->validar($request->all());
      if ($validation->fails()) {
         $errors = $validation->errors()->getMessages();
         return redirect()->back()->withErrors($errors);
      }
      try {
         Cliente::create($request->all());
         return redirect()->route('cliente.index');
      } catch (Exception $e) {
         dd($e->getMessage());
      }
   }

   public function update(Request $request,$id)
   {
      $validation = $this->validar($request->all());
      if ($validation->fails()) {
         $errors = $validation->errors()->getMessages();
         return redirect()->back()->withErrors($errors);
      }
      try {
         Cliente::find($request['id'])->update($request->all());
         return redirect()->route('cliente.index');
      } catch (Exception $e) {
         dd($e->getMessage());
      }
   }

   public function edit(Cliente $edit)
   {
      $clientes = Cliente::select('id','logradouro','cep','nome','logradouro','data_nascimento','complemento','identidade','telefone')->get();
      return view('cliente._edit',compact('clientes','edit'));
   }

   public function delete(Request $request)
   {
      try {
         Cliente::find($request['id'])->delete();
         return redirect()->route('cliente.index');
      } catch (Exception $e) {
         dd($e->getMessage());
      }
   }
}
