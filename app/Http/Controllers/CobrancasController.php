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
        // $query = "
        // select c.id as id, MAX(CASE WHEN MONTH(cg.vencimento_original) = MONTH(CURDATE()) THEN cg.valor END) AS valor, cg.cpf as cpf, c.contrato_id, cg.nome as cliente_nome, ce.descricao as contaefi, max(cg.vencimento) as ultimo_vencimento,
        //     max(case when cg.vencimento_original < CURDATE() and cg.status <> 'CONCLUIDA' then 1
        //         else null
        //         end) as inadimplente,
        //         CONCAT(
        //             CASE
        //                 WHEN MAX(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN 1 ELSE 0 END) = 1 THEN
        //                     SUBSTRING(MIN(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN cg.vencimento_original END), 9, 2)
        //                 ELSE
        //                     SUBSTRING(MAX(CASE WHEN MONTH(cg.vencimento_original) = MONTH(CURDATE()) THEN cg.vencimento_original END), 9, 2)
        //             END,
        //             '/',
        //             CASE
        //                 WHEN MAX(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN 1 ELSE 0 END) = 1 THEN
        //                     LPAD(MONTH(MIN(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN cg.vencimento_original END)), 2, '0')
        //                 ELSE
        //                     LPAD(MONTH(CURDATE()), 2, '0')
        //             END
        //         ) AS dia_venc
        //     from cobrancas c
        //     join cobrancas_geradas cg on cg.cobrancas_id = c.id
        //     join contasefi ce on ce.id = cg.contaefi
        //     group by c.id
        // ";

        $timezone = 'America/Sao_Paulo';

        // Execute a query para definir o fuso horário
        DB::statement("SET time_zone = '$timezone'");
        $query = "
            select c.id as id,  COALESCE(
                MAX(CASE WHEN MONTH(cg.vencimento_original) = MONTH(CURDATE()) THEN cg.valor END),
                MAX(CASE WHEN MONTH(cg.vencimento_original) = MONTH(CURDATE()) - 1 THEN cg.valor END)
            ) AS valor, cg.cpf as cpf, c.contrato_id, cg.nome as cliente_nome, ce.descricao as contaefi, max(cg.vencimento) as ultimo_vencimento, cc.estado as uf,
            MAX(CASE
                WHEN cg.vencimento_original < CURDATE() THEN
                    CASE
                        WHEN DATEDIFF(CURDATE(), cg.vencimento_original) <= 2 AND cg.status = 'ATIVA' THEN 2
                        WHEN DATEDIFF(CURDATE(), cg.vencimento_original) > 2 AND cg.status = 'ATIVA' THEN 3
                    END
                ELSE NULL
            END) AS inadimplente,
                CONCAT(
                    CASE
                        WHEN MAX(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN 1 ELSE 0 END) = 1 THEN
                            SUBSTRING(MIN(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN cg.vencimento_original END), 9, 2)
                        ELSE
                            SUBSTRING(MAX(CASE WHEN MONTH(cg.vencimento_original) = MONTH(CURDATE()) THEN cg.vencimento_original END), 9, 2)
                    END,
                    '/',
                    CASE
                        WHEN MAX(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN 1 ELSE 0 END) = 1 THEN
                            LPAD(MONTH(MIN(CASE WHEN cg.vencimento_original < CURDATE() AND cg.status <> 'CONCLUIDA' THEN cg.vencimento_original END)), 2, '0')
                        ELSE
                            LPAD(MONTH(CURDATE()), 2, '0')
                    END
                ) AS dia_venc
            from cobrancas c
            join cobrancas_geradas cg on cg.cobrancas_id = c.id
            join contasefi ce on ce.id = cg.contaefi
            join clientes cc on cc.cpf = cg.cpf
            group by c.id
        ";
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
