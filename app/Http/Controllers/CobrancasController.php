<?php

namespace App\Http\Controllers;

use App\Models\Cobrancas as Cobrancas;
use App\Http\Resources\Cobrancas as CobrancasResource;
use Illuminate\Http\Request;

class CobrancasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobrancas = \DB::table('cobrancas')
            ->select('cobrancas.*', \DB::raw('(select c.id as cliente_id from cobrancas
            join contratos ct on ct.id = cobrancas.contrato_id
            join clientes c on c.id = ct.cliente_id
            where ct.id = cobrancas.contrato_id
            group by c.id) as cliente_id
            '),
            \DB::raw('(select c.nome as cliente_nome from cobrancas
            join contratos ct on ct.id = cobrancas.contrato_id
            join clientes c on c.id = ct.cliente_id
            where ct.id = cobrancas.contrato_id
            group by c.nome) as cliente_nome
            '),
            \DB::raw('(select 1 vencido from cobrancas_geradas cg where cg.vencimento < CURDATE() and cg.status <> "CONCLUIDA" and cg.contrato_id = cobrancas.contrato_id) as inadimplente'), \DB::raw('(SELECT IFNULL(MAX(vencimento), "0000-00-00") ultimo_vencimento FROM cobrancas_geradas 
            WHERE contrato_id = cobrancas.contrato_id and status <> "CONCLUIDA") as ultimo_vencimento'))
            ->get();
        //$cobrancas = Cobrancas::all();
        return $cobrancas;
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
        $cobranca = new Cobrancas;
        $cobranca->descricao = $request->input('descricao');
        $cobranca->contrato_id = $request->input('contrato_id');
        $cobranca->valor = $request->input('valor');
        $cobranca->parcelas = $request->input('parcelas');     
        $cobranca->obs = $request->input('obs');

        if( $cobranca->save() ){
            return $cobranca;
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
        $cobranca = Cobrancas::findOrFail( $request->id );
        $cobranca->descricao = $request->input('descricao');
        $cobranca->contrato_id = $request->input('contrato_id');
        $cobranca->valor = $request->input('valor');
        $cobranca->parcelas = $request->input('parcelas');     
        $cobranca->obs = $request->input('obs');

        if( $cobranca->save() ){
            return $cobranca;
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
        $cobranca = Cobrancas::find($id);
        $cobranca->delete();

        if($cobranca->delete()){
            return $cobranca;
        }
    }
}
