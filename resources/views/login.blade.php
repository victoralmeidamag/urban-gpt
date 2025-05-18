@extends('layouts.app')

@section('title', 'Login')

@section('additional-styles')
<style>
    .login-card {
        background: white;
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        border: 1px solid #f0f0f0;
        margin: 0 auto;
    }

    .login-title {
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

    .login-button {
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

    .login-button:hover {
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

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .remember-me input[type="checkbox"] {
        accent-color: #ea5473;
    }

    .forgot-link {
        color: #ea5473;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ea5473;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 2rem;
            margin: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="login-card">
    <h1 class="login-title">Login</h1>
    
    <form method="POST" action="{{ route('login-user') }}">
        @csrf
        
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
                autocomplete="current-password"
                placeholder="Digite sua senha"
            >
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="remember-forgot">
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" style="color: #4a4a4a; font-size: 0.9rem;">Lembrar-me</label>
            </div>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <button type="submit" class="login-button">
            Entrar
        </button>
    </form>

    <div class="form-links">
        <span>Não tem uma conta?</span>
        <a href="{{ route('register') }}">Cadastre-se</a>
    </div>
</div>
@endsection