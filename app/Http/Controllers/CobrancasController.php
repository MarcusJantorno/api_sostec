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
        $query = '
        SELECT cobrancas.id as id, cobrancas.contrato_id as contrato_id, cobrancas.valor as valor,
        case when cobrancas.contrato_id IS NULL then (select max(vencimento) from cobrancas_geradas cg3 where cg3.cobrancas_id = cobrancas.id)
        else (select max(vencimento) from cobrancas_geradas cg3 where cg3.contrato_id = cobrancas.contrato_id)
        end as ultimo_vencimento,
        case when cobrancas.contrato_id IS NULL then (select SUBSTRING(max(vencimento), 9,10) from cobrancas_geradas cg3 where cg3.cobrancas_id = cobrancas.id)
        else (select SUBSTRING(max(vencimento), 9,10) from cobrancas_geradas cg3 where cg3.contrato_id = cobrancas.contrato_id)
        end as dia_venc,
        case when cobrancas.contrato_id IS NULL then (select distinct cf.descricao from cobrancas_geradas cg4 join contasefi cf on cf.id = cg4.contaefi where cg4.cobrancas_id = cobrancas.id)
        else (select distinct cf.descricao from cobrancas_geradas cg4 join contasefi cf on cf.id = cg4.contaefi where cg4.contrato_id = cobrancas.contrato_id)
        end as contaefi,
        case when cobrancas.contrato_id IS NULL then (select distinct c.cpf from cobrancas_geradas cg5 join clientes c on c.cpf = cg5.cpf where cg5.cobrancas_id = cobrancas.id)
        else (select DISTINCT c.cpf from cobrancas_geradas cg5 join contratos ct on ct.id = cg5.contrato_id join clientes c on c.id = ct.cliente_id where cg5.contrato_id = cobrancas.contrato_id)
        end as cpf,
                case
                    when cobrancas.contrato_id IS NULL then (select UPPER(cg2.nome) from cobrancas_geradas cg2 where cg2.cobrancas_id = cobrancas.id
        ORDER BY `contaefi` ASC LIMIT 1)
            else (select (select clientes.nome from clientes where id = contratos.cliente_id ) from contratos where contratos.id = cobrancas.contrato_id)
        end as cliente_nome,
        case
            when cobrancas.contrato_id IS NULL then (SELECT IFNULL(MAX(vencimento), "0000-00-00") ultimo_vencimento FROM cobrancas_geradas WHERE cobrancas_geradas.cobrancas_id = cobrancas.id and status <> "CONCLUIDA")
            else (SELECT IFNULL(MAX(vencimento), "0000-00-00") ultimo_vencimento FROM cobrancas_geradas WHERE contrato_id = cobrancas.contrato_id and status <> "CONCLUIDA")
        end as ultimo_vencimento,
        case
            when cobrancas.contrato_id IS NULL then (select 1 vencido from cobrancas_geradas cg where cg.vencimento < CURDATE() and cg.status <> "CONCLUIDA" and cg.cobrancas_id = cobrancas.id)
            else (select 1 vencido from cobrancas_geradas cg where cg.vencimento < CURDATE() and cg.status <> "CONCLUIDA" and cg.contrato_id = cobrancas.contrato_id)
        end as inadimplente
        FROM cobrancas;
        ';
        $cobrancas = \DB::select($query);
        //cobrancas = Cobrancas::all();
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
