<?php

namespace App\Http\Controllers;

use App\Models\ContratoEmpresa as ContratoEmpresa;
use App\Http\Resources\ContratoEmpresa as ContratoEmpresaResource;
use Illuminate\Http\Request;

class ContratoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratosEmpresa = ContratoEmpresa::all();
        return $contratosEmpresa;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contratoEmpresa = new ContratoEmpresa;
        $contratoEmpresa->numero = $request->input('numero');
        $contratoEmpresa->titular = $request->input('titular');
        $contratoEmpresa->cpf = $request->input('cpf');
        $contratoEmpresa->vencimento = $request->input('vencimento');
        $contratoEmpresa->quantidade_pontos = $request->input('quantidade_pontos');
        $contratoEmpresa->valor_ponto = $request->input('valor_ponto');
        $contratoEmpresa->cep = $request->input('cep');
        $contratoEmpresa->logradouro = $request->input('logradouro');
        $contratoEmpresa->bairro = $request->input('bairro');
        $contratoEmpresa->cidade = $request->input('cidade');
        $contratoEmpresa->estado = $request->input('estado');
        $contratoEmpresa->telefone = $request->input('telefone');
        $contratoEmpresa->estado = $request->input('data_nascimento');
        $contratoEmpresa->estado = $request->input('idade');
        $contratoEmpresa->estado = $request->input('vip');
        $contratoEmpresa->email = $request->input('email');

        if( $contratoEmpresa->save() ){
            return $contratoEmpresa;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contratoEmpresa = ContratoEmpresa::findOrFail( $request->id );
        $contratoEmpresa->numero = $request->input('numero');
        $contratoEmpresa->titular = $request->input('titular');
        $contratoEmpresa->cpf = $request->input('cpf');
        $contratoEmpresa->vencimento = $request->input('vencimento');
        $contratoEmpresa->quantidade_pontos = $request->input('quantidade_pontos');
        $contratoEmpresa->valor_ponto = $request->input('valor_ponto');
        $contratoEmpresa->cep = $request->input('cep');
        $contratoEmpresa->logradouro = $request->input('logradouro');
        $contratoEmpresa->bairro = $request->input('bairro');
        $contratoEmpresa->cidade = $request->input('cidade');
        $contratoEmpresa->estado = $request->input('estado');
        $contratoEmpresa->telefone = $request->input('telefone');
        $contratoEmpresa->estado = $request->input('data_nascimento');
        $contratoEmpresa->estado = $request->input('idade');
        $contratoEmpresa->estado = $request->input('vip');
        $contratoEmpresa->email = $request->input('email');

        if( $contratoEmpresa->save() ){
            return $contratoEmpresa;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratoEmpresa = ContratoEmpresa::find($id);
        $contratoEmpresa->delete();

        if($contratoEmpresa->delete()){
            return $contratoEmpresa;
        }
    }
}
