<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo 'Peter Lange';
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
        $us = $request->all();

        $usuario = new Usuario();
        $usuario->nome = $us['nome'];
        $usuario->email = $us['email'];
        $usuario->senha = $us['senha'];
        $confirmarSenha = $us['confirmarSenha'];
        
        // Checa se as senhas digitadas são iguais
        if ($usuario->senha != $confirmarSenha)
        return response('Senhas não conferem!', 400);

        // Checa se o email digitado já existe
        $usuarioExiste= Usuario::where('email', $usuario->email )->first();
        if($usuarioExiste) {
            return response('Já existe um usuario com esse email!', 400);
        }

        // Se tudo deu certo, encripta a senha e salva no banco
        $usuario->senha = Hash::make( $usuario->senha );
        $usuario->save(); 

        // retorna o usuário só para fins de checagem
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(Request $request){

        $email = $request->input('email');
        $senha = $request->input('senha');

        // Verifica se ambos os campos foram preenchidos
        if(!$email || !$senha) {
            return response('Credenciais invalidas!', 400);
        }
        
        // verifica se existe o email digitado no banco
        // Caso esteja certa, joga os dados do usuario na variavel $usuario
        $usuario = Usuario::where('email', $email)->first();
        // print_r($usuario);
        if (!$usuario) {
            return response('Credenciais invalidas!', 400);
        }

        // Verifica se a senha digitada confere com a senha do banco. 
        if(!Hash::check($senha, $usuario->senha)){
            return response('Senha Invalida', 400);

        }

        // retorna o usuário só para fins de checagem
        echo 'Login Efetuado com Sucesso. Bem vindo: ';
        return response($usuario->nome, 200);
        // return $usuario;

    }
}
