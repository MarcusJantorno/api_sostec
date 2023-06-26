<?php

namespace App\Http\Controllers;

use App\Models\ContasEfi as ContasEfi;
use App\Http\Resources\ContasEfi as ContasEfiResource;
use Illuminate\Http\Request;

class ContasEfiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contasEfi = ContasEfi::all();
        return $contasEfi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contasEfi = new ContasEfi;
        $contasEfi->descricao = $request->input('descricao');
        $contasEfi->client_id = $request->input('client_id');
        $contasEfi->client_secret = $request->input('client_secret');
        $contasEfi->certificado = $request->input('certificado');
        $contasEfi->chave_pix = $request->input('chave_pix');

        if( $contasEfi->save() ){
            return $contasEfi;
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
        $contasEfi = ContasEfi::findOrFail( $request->id );
        $contasEfi->descricao = $request->input('descricao');
        $contasEfi->client_id = $request->input('client_id');
        $contasEfi->client_secret = $request->input('client_secret');
        $contasEfi->certificado = $request->input('certificado');
        $contasEfi->chave_pix = $request->input('chave_pix');

        if( $contasEfi->save() ){
            return $contasEfi;
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
        $contasEfi = ContasEfi::find($id);
        $contasEfi->delete();

        if($contasEfi->delete()){
            return $contasEfi;
        }
    }
}
