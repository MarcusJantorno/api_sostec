<?php

namespace App\Http\Controllers;

use App\Models\Cliente as Cliente;
use App\Http\Resources\Cliente as ClienteResource;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return $clientes;
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
        $cliente = new Cliente;
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->cpf = $request->input('cpf');
        $cliente->telefone1 = $request->input('telefone1');
        $cliente->telefone2 = $request->input('telefone2');
        $cliente->telefone3 = $request->input('telefone3');
        $cliente->obs = $request->input('obs');

        if( $cliente->save() ){
            return $cliente;
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
        $cliente = Cliente::findOrFail( $request->id );
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->cpf = $request->input('cpf');
        $cliente->telefone1 = $request->input('telefone1');
        $cliente->telefone2 = $request->input('telefone2');
        $cliente->telefone3 = $request->input('telefone3');
        $cliente->obs = $request->input('obs');

        if( $cliente->save() ){
            return $cliente;
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
