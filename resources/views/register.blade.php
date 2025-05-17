@extends('layouts.app')

@section('title', 'Cadastro')

@section('additional-styles')
<style>
    .register-card {
        background: white;
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        border: 1px solid #f0f0f0;
        margin: 0 auto;
    }

    .register-title {
        text-align: center;
        color: #ea5473;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #4a4a4a;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-input {
        width: 100%;
        padding: 1rem;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        background-color: #fafafa;
    }

    .form-input:focus {
        outline: none;
        border-color: #ea5473;
        background-color: white;
    }

    .register-button {
        width: 100%;
        padding: 1rem;
        background-color: #ea5473;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 1rem;
    }

    .register-button:hover {
        background-color: #d44567;
    }

    .form-links {
        text-align: center;
        margin-top: 1.5rem;
    }

    .form-links a {
        color: #ea5473;
        text-decoration: none;
        font-size: 0.95rem;
        margin: 0 0.5rem;
    }

    .form-links a:hover {
        text-decoration: underline;
    }

    .password-requirements {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 1rem;
        margin-top: 0.5rem;
    }

    .password-requirements h5 {
        color: #4a4a4a;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .password-requirements ul {
        list-style: none;
        padding: 0;
    }

    .password-requirements li {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.3rem;
        padding-left: 1rem;
        position: relative;
    }

    .password-requirements li:before {
        content: "•";
        color: #ea5473;
        position: absolute;
        left: 0;
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .terms-checkbox input[type="checkbox"] {
        margin-top: 0.2rem;
        accent-color: #ea5473;
    }

    .terms-checkbox label {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .terms-checkbox a {
        color: #ea5473;
        text-decoration: none;
    }

    .terms-checkbox a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ea5473;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 480px) {
        .register-card {
            padding: 2rem;
            margin: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="register-card">
    <h1 class="register-title">Cadastro</h1>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Nome Completo</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input" 
                value="{{ old('name') }}"
                required 
                autocomplete="name"
                placeholder="Digite seu nome completo"
            >
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-input" 
                value="{{ old('email') }}"
                required 
                autocomplete="email"
                placeholder="Digite seu e-mail"
            >
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input" 
                required
                autocomplete="new-password"
                placeholder="Digite sua senha"
            >
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
            
            <div class="password-requirements">
                <h5>Requisitos da senha:</h5>
                <ul>
                    <li>Pelo menos 8 caracteres</li>
                    <li>Pelo menos uma letra maiúscula</li>
                    <li>Pelo menos uma letra minúscula</li>
                    <li>Pelo menos um número</li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-input" 
                required
                autocomplete="new-password"
                placeholder="Confirme sua senha"
            >
            @error('password_confirmation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="terms-checkbox">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">
                Eu concordo com os 
                <a href="/termos-de-uso" target="_blank">Termos de Uso</a> 
                e 
                <a href="/politica-privacidade" target="_blank">Política de Privacidade</a>
            </label>
        </div>

        <button type="submit" class="register-button">
            Criar Conta
        </button>
    </form>

    <div class="form-links">
        <span>Já tem uma conta?</span>
        <a href="{{ route('login') }}">Faça login</a>
    </div>
</div>
@endsection