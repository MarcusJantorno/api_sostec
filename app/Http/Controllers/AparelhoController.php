<?php

namespace App\Http\Controllers;

use App\Models\Aparelho as Aparelho;
use App\Http\Resources\Aparelho as AparelhoResource;
use Illuminate\Http\Request;

class AparelhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aparelhos = Aparelho::all();
        return $aparelhos;
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
        $aparelho = new Aparelho;
        $aparelho->modelo = $request->input('modelo');
        $aparelho->obs = $request->input('obs');
        
        if( $aparelho->save() ){    
            return $aparelho;
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
        $aparelho = Aparelho::findOrFail( $request->id );
        $aparelho->modelo = $request->input('modelo');
        $aparelho->obs = $request->input('obs');
        
        if( $aparelho->save() ){    
            return $aparelho;
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
