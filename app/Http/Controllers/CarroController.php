<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //Captura os dados do carro enviados à API
        $dadosCarro = $request->all();

        $carro = new Carro();
        $carro->modelo =  $dadosCarro['modelo'];
        $carro->montadora = $dadosCarro['montadora'];
        $carro->consumoAlcool = $dadosCarro['consumoAlcool'];
        $carro->consumoGasolina = $dadosCarro['consumoGasolina'];
        $carro->usuario_id = $dadosCarro['usuario_id'];

        // if(!$carro->modelo || !$carro->montadora || !$carro->consumoAlcool || !$carro->consumoGasolina|| !$carro->usuario_id ) {
        //     return response('TODOS os campos são OBRIGATÓRIOS!', 400);
        // }

        if(!$carro->modelo)         {
            return response('Favor informar o MODELO', 400);
        }
        if(!$carro->montadora)         {
            return response('Favor informar a MONTADORA', 400);
        }
        if(!$carro->consumoAlcool)         {
            return response('Favor informar qual o comsumo quando usando Alcoo!', 400);
        }
        if(!$carro->consumoGasolina)         {
            return response('Favor informar qual o comsumo quando usando GASOLINA!', 400);
        }
        if(!$carro->usuario_id)         {
            return response('Favor informar a qual usuario o carro pertence', 400);
        }
        
        $usuario = new Usuario();
        $usuario = Usuario::where('id', $carro->usuario_id)->first();
        if (!$usuario) {
            return response('Esse usuario não existe!', 400);
        }
        
        $carro->save();
        return $carro;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show(Carro $carro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function edit(Carro $carro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carro $carro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carro $carro)
    {
        //
    }
}
