<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Minha Aplicação'))</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonte e ícones -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', 'Arial', sans-serif;
            background-color: #ede2d4;
            color: #4a4a4a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-navbar {
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #e7e7e7;
            position: relative;
        }

        .header-logo {
            height: 60px;
            max-width: 200px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-logo img {
            height: 100%;
            width: auto;
            object-fit: contain;
        }

        .header-logo .brand-text {
            font-weight: 700;
            font-size: 1.25rem;
            color: #ea5473;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .header-nav-link {
            color: #4a4a4a;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-nav-link:hover {
            color: #ea5473;
            background-color: #fdf2f5;
            text-decoration: none;
        }

        .header-nav-link.active {
            color: #ea5473;
            background-color: #ea54731a;
            font-weight: 600;
        }

        /* Botão toggle para mobile */
        .navbar-toggler {
            border: none;
            background: none;
            padding: 0.25rem 0.5rem;
            font-size: 1.5rem;
            color: #4a4a4a;
            display: none;
            cursor: pointer;
        }

        .navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 160px);
        }

        .content-wrapper {
            width: 100%;
            max-width: 1200px;
        }

        .footer {
            padding: 20px 0;
            background-color: #f1f1f1;
            border-top: 1px solid #e7e7e7;
            text-align: center;
            margin-top: auto;
        }

        .footer p {
            margin-bottom: 0;
            color: #666;
        }

        /* Responsividade aprimorada */
        @media (max-width: 992px) {
            .header-navbar {
                padding: 1rem;
                flex-wrap: wrap;
            }

            .navbar-toggler {
                display: block;
            }

            .header-nav {
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
                padding: 1rem 0;
                border-top: 1px solid #e7e7e7;
                display: none;
            }

            .header-nav.show {
                display: flex;
            }

            .header-nav-link {
                width: 100%;
                text-align: left;
                padding: 0.75rem 1rem;
                border-radius: 8px;
            }

            .main-content {
                padding: 1rem;
                min-height: calc(100vh - 200px);
            }
        }

        @media (max-width: 576px) {
            .header-navbar {
                padding: 0.75rem;
            }

            .header-logo {
                height: 50px;
            }

            .navbar-toggler {
                font-size: 1.25rem;
            }
        }

        /* Estilos adicionais que podem ser úteis */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #f0f0f0;
        }

        .btn-primary {
            background-color: #ea5473;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #d44567;
            color: white;
        }

        .text-primary {
            color: #ea5473;
        }

        .text-muted {
            color: #999;
        }

        /* Animação suave para o menu */
        .header-nav {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        @yield('additional-styles')
        @stack('styles')
    </style>
</head>
<body>
    <header class="header-navbar">
        <div class="header-logo">
            <img src="{{asset('images/LOGO TOPO.png')}}" alt="Logo">
        </div>
        
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        
        <nav class="header-nav" id="navbarNav">
            <a href="{{ route('chat.gpt') ?? '#' }}" class="header-nav-link @if(request()->routeIs('chat.gpt')) active @endif">
                <i class="bi bi-chat-dots"></i> Chat
            </a>
            
            @auth
                <a href="{{ route('dashboard') ?? '#' }}" class="header-nav-link @if(request()->routeIs('dashboard')) active @endif">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="#" class="header-nav-link" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </a>
                <form id="logout-form" action="{{ route('logout') ?? '#' }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') ?? '#' }}" class="header-nav-link @if(request()->routeIs('login')) active @endif">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('register') ?? '#' }}" class="header-nav-link @if(request()->routeIs('register')) active @endif">
                    <i class="bi bi-person-plus"></i> Cadastro
                </a>
            @endauth
        </nav>
    </header>

    <main class="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Minha Aplicação') }}. Todos os direitos reservados.</p>
            @yield('footer')
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script aprimorado para toggle do menu mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggler = document.querySelector('.navbar-toggler');
            const nav = document.querySelector('.header-nav');
            
            if (toggler && nav) {
                toggler.addEventListener('click', function() {
                    nav.classList.toggle('show');
                    
                    // Atualiza o ícone do botão
                    const icon = toggler.querySelector('i');
                    if (nav.classList.contains('show')) {
                        icon.classList.remove('bi-list');
                        icon.classList.add('bi-x');
                    } else {
                        icon.classList.remove('bi-x');
                        icon.classList.add('bi-list');
                    }
                });
            }

            // Fecha o menu quando clicar em um link (em mobile)
            const links = document.querySelectorAll('.header-nav-link');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        nav.classList.remove('show');
                        const icon = toggler.querySelector('i');
                        icon.classList.remove('bi-x');
                        icon.classList.add('bi-list');
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    nav.classList.remove('show');
                    const icon = toggler.querySelector('i');
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            });
        });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>