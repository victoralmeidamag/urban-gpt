<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->except("_token");
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with("error","Usuário ou senha incorretos");
        }
        return redirect()->route("home")->with("success","Logado");
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted'
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('home')->with('success', 'Registro concluído com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success','Deslogado');
    }
}