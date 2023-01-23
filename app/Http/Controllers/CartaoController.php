<?php

namespace App\Http\Controllers;

use App\Models\Cartao as Cartao;
use App\Http\Resources\Cartao as CartaoResource;
use Illuminate\Http\Request;

class CartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartoes = Cartao::all();
        return $cartoes;
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
        $cartao = new Cartao;
        $cartao->nome = $request->input('nome');
        $cartao->contratoempresa_id = $request->input('contratoempresa_id');
        $cartao->numero = $request->input('numero');
        $cartao->nds = $request->input('nds');
        $cartao->aparelho_id = $request->input('aparelho_id');

        if( $cartao->save() ){
            return $cartao;
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
        $cartao = Cartao::findOrFail( $request->id );
        $cartao->nome = $request->input('nome');
        $cartao->contratoempresa_id = $request->input('contratoempresa_id');
        $cartao->numero = $request->input('numero');
        $cartao->nds = $request->input('nds');
        $cartao->aparelho_id = $request->input('aparelho_id');

        if( $cartao->save() ){
            return $cartao;
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
        $cartao = Cartao::find($id);
        $cartao->delete();

        if($cartao->delete()){
            return $cartao;
        }
    }
}
