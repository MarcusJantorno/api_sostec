<?php

namespace App\Http\Controllers;

use App\Models\Contrato as Contrato;
use App\Http\Resources\Contrato as ContratoResource;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = \DB::table('contratos')
            ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
            ->join('cobrancas_geradas', 'cobrancas_geradas.contrato_id', '=', 'contratos.id')
            ->select('contratos.*', 'clientes.nome', \DB::raw('(SELECT MAX(vencimento) ultimo_vencimento FROM cobrancas_geradas 
            WHERE cobrancas_geradas.contrato_id = contratos.id and cobrancas_geradas.status <> "CONCLUIDA") as ultimo_vencimento'))
            ->groupBy(\DB::raw('ultimo_vencimento, contratos.*'))
            ->get();
        //$contratos = Contrato::all();
        return $contratos;
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
        $contrato = new Contrato;
        $contrato->nome = $request->input('nome');
        $contrato->cliente_id = $request->input('cliente_id');
        $contrato->logradouro = $request->input('logradouro');
        $contrato->bairro = $request->input('bairro');
        $contrato->cidade = $request->input('cidade');
        $contrato->estado = $request->input('estado');
        $contrato->ponto = $request->input('ponto');
        $contrato->cep = $request->input('cep');
        $contrato->cartao_id = $request->input('cartao_id');
        $contrato->data_instalacao = $request->input('data_instalacao');
        $contrato->contratoempresa_id = $request->input('contratoempresa_id');
        $contrato->aparelho_id = $request->input('aparelho_id');
        $contrato->numero_serie = $request->input('numero_serie');
        $contrato->dia_vencimento = $request->input('dia_vencimento');
        $contrato->data_vencimento = $request->input('data_vencimento');
        $contrato->valor = $request->input('valor');
        $contrato->obs = $request->input('obs');

        if( $contrato->save() ){
            return $contrato;
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
        $contrato = Contrato::findOrFail( $request->id );
        $contrato->nome = $request->input('nome');
        $contrato->cliente_id = $request->input('cliente_id');
        $contrato->logradouro = $request->input('logradouro');
        $contrato->bairro = $request->input('bairro');
        $contrato->cidade = $request->input('cidade');
        $contrato->estado = $request->input('estado');
        $contrato->ponto = $request->input('ponto');
        $contrato->cep = $request->input('cep');
        $contrato->cartao_id = $request->input('cartao_id');
        $contrato->data_instalacao = $request->input('data_instalacao');
        $contrato->contratoempresa_id = $request->input('contratoempresa_id');
        $contrato->aparelho_id = $request->input('aparelho_id');
        $contrato->numero_serie = $request->input('numero_serie');
        $contrato->dia_vencimento = $request->input('dia_vencimento');
        $contrato->data_vencimento = $request->input('data_vencimento');
        $contrato->valor = $request->input('valor');
        $contrato->obs = $request->input('obs');

        if( $contrato->save() ){
            return $contrato;
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
        $contrato = Contrato::find($id);
        $contrato->delete();

        if($contrato->delete()){
            return $contrato;
        }
    }
}
