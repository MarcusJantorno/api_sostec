<?php

namespace App\Http\Controllers;

use App\Models\FaturaContrato as FaturaContrato;
use App\Http\Resources\FaturaContrato as FaturaContratoResource;
use Illuminate\Http\Request;

class FaturaContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faturasContrato = FaturaContrato::all();
        return $faturasContrato;
    }

    public function maxData(Request $request)
    {
        $faturaContrato = FaturaContrato::findOrFail( $request->id )->max('data');
        return $faturaContrato;
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
        $faturaContrato = new FaturaContrato;
        $faturaContrato->valor = $request->input('valor');
        $faturaContrato->data = $request->input('data');
        $faturaContrato->contratoempresa_id = $request->input('contratoempresa_id');

        if( $faturaContrato->save() ){
            return $faturaContrato;
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
        $faturaContrato = FaturaContrato::findOrFail( $request->id );
        $faturaContrato->valor = $request->input('valor');
        $faturaContrato->data = $request->input('data');
        $faturaContrato->contratoempresa_id = $request->input('contratoempresa_id');

        if( $faturaContrato->save() ){
            return $faturaContrato;
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
        //
    }
}
