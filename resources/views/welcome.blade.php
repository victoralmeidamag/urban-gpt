<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanGuide - Reduza a burocracia e aumente seu tempo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #e94869;
            --secondary-color: #454953;
            --light-bg: #f2ece5;
            --dark-blue: #3a5577;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        /* Header */
        .header {
            background-color: var(--light-bg);
            padding: 1rem 0;
        }
        
        .logo {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }
        
        .logo img {
            height: 30px;
            margin-right: 10px;
        }
        
        .nav-link {
            color: var(--secondary-color);
            margin: 0 15px;
            font-weight: 500;
        }
        
        .btn-entrar {
            background-color: var(--white);
            color: var(--secondary-color);
            border: 1px solid #ccc;
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            font-weight: 500;
        }
        
        /* Hero Section */
        .hero {
            background-color: var(--light-bg);
            padding: 4rem 0;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        
        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: var(--secondary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem;
            font-weight: 500;
            border-radius: 4px;
        }
        
        .btn-primary:hover {
            background-color: #d13c5d;
            border-color: #d13c5d;
        }

        /* Features */
        .features {
            padding: 3rem 0;
        }
        
        .feature-box {
            text-align: center;
            padding: 2rem 1rem;
            border-right: 1px solid #eee;
        }
        
        .feature-box:last-child {
            border-right: none;
        }
        
        .feature-icon {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .feature-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }
        
        .feature-text {
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Blue Sections */
        .blue-section {
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 4rem 0;
        }
        
        .blue-section h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .blue-section p {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        
        /* Stats Section */
        .stats {
            background-color: var(--light-bg);
            padding: 4rem 0;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-text {
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Testimonials */
        .testimonial {
            background-color: var(--light-bg);
            padding: 3rem 0;
        }
        
        .testimonial-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .testimonial-position {
            color: #666;
            font-size: 0.9rem;
        }
        
        /* Call to Action */
        .cta {
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 4rem 0;
        }
        
        .cta h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        /* Footer */
        .footer {
            background-color: #333;
            color: var(--white);
            padding: 4rem 0 2rem;
        }
        
        .footer h5 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .footer a {
            color: #aaa;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .footer a:hover {
            color: var(--white);
        }
        
        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 2rem;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #aaa;
        }
        
        .social-icon {
            color: var(--white);
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        /* Images placeholders */
        .img-placeholder {
            background-color: #eee;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        
        .stats-icon {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .partners-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem 0;
        }
        
        .partner-logo {
            max-width: 100px;
            height: auto;
            opacity: 0.7;
        }
        
        .partner-logo:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand logo" href="#">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    UrbanGuide
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Planos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Suporte</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-entrar" href="#">Entrar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Aumente seu tempo e reduza a burocracia</h1>
                    <p>Digite um endereço e entenda exatamente o que o Plano Diretor permite construir</p>
                    <a href="#" class="btn btn-primary">Conheça Nossos Planos</a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <!-- Placeholder for hero image -->
                        <img src="{{ asset('images/ChatGPT Image 8 de abr. de 2025, 07_26_11.png') }}" alt="Pessoas segurando um marcador" class="img-fluid">

                        <div class="stats-box position-absolute" style="top: 10%; right: 10%;">
                            <div class="badge bg-light text-dark p-2">
                                100% dos municípios brasileiros
                            </div>
                        </div>
                        <div class="stats-box position-absolute" style="bottom: 10%; right: 5%;">
                            <div class="badge bg-light text-dark p-2">
                                +850 milhões de hectares com potencial construtivo
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="feature-title">+ Agilidade</h3>
                        <p class="feature-text">Consulte as regras do plano diretor em segundos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="feature-title">+ Clareza</h3>
                        <p class="feature-text">Receba as informações urbanísticas de forma simples</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">+ Segurança</h3>
                        <p class="feature-text">Evite erros e construa com base em dados oficiais</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">+ Eficiência</h3>
                        <p class="feature-text">Economize tempo em cada análise de viabilidade</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Logos -->
    <section class="partners">
        <div class="container">
            <div class="partners-logos">
                <!-- Placeholder for partner logos -->
                <img src="{{ asset('images/APOLAR 01.png') }}" alt="Apolar" class="partner-logo">
                <img src="{{ asset('images/MRV O1.png') }}" alt="MRV" class="partner-logo">
                <img src="{{ asset('images/DIRECIONAL 01.png') }}" alt="Direcional" class="partner-logo">
                <img src="{{ asset('images/FG 01.png') }}" alt="FG" class="partner-logo">
                <img src="{{ asset('images/DUDA 01.png') }}" alt="Duda" class="partner-logo">
            </div>
        </div>
    </section>

    <!-- Blue Section 1 -->
    <section class="blue-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2>Explore todo o potencial construtivo do seu terreno</h2>
                    <p>Descubra o que pode ser construído em qualquer endereço com base no plano diretor oficial da cidade. Mais clareza, menos incertezas.</p>
                    <hr class="divider">
                    <a href="#" class="text-white">Conheça os diferenciais da plataforma</a>
                </div>
                <div class="col-lg-6">
                <img src="{{ asset('images/grafico1.png') }}" alt="Duda" class="partner-logo">
            </div>
            </div>
        </div>
    </section>

    <!-- Feature Sections -->
    <section class="blue-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2>Descubra o potencial do seu terreno com rapidez</h2>
                    <p>Na etapa Consultar, você insere um endereço e visualiza de forma clara o que pode ou não ser construído no local. Com dados atualizados e interpretação automática da legislação, você ganha tempo e evita erros.</p>
                </div>
                <div class="col-lg-6">
                    <div class="img-placeholder">
                        <!-- Placeholder para imagens de gráficos -->
                        <span>Imagens de gráficos e visualizações</span>
                    </div>
                </div>
            </div>
            
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2>Receba todas as diretrizes urbanísticas direto na tela</h2>
                    <p>Na etapa Analisar, o UrbanGuide entrega as informações completas de zoneamento, uso do solo e restrições legais. Tudo organizado para facilitar decisões técnicas, sem precisar abrir dezenas de documentos.</p>
                </div>
                <div class="col-lg-6">
                    <div class="img-placeholder">
                        <!-- Placeholder para imagens de gráficos -->
                        <span>Imagens de gráficos e visualizações</span>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <h2>Tome decisões com segurança jurídica e agilidade</h2>
                    <p>Na etapa Decidir, você cruza as informações com seus objetivos e já sabe quais projetos são viáveis no local. Ideal para arquitetos, engenheiros e investidores que buscam assertividade desde o início.</p>
                </div>
                <div class="col-lg-6">
                    <div class="img-placeholder">
                        <!-- Placeholder para imagens de gráficos -->
                        <span>Imagens de gráficos e visualizações</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Updates Section -->
    <section class="blue-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>Fique por dentro de mudanças no plano diretor da sua cidade</h2>
                    <p>Na etapa Acompanhar, você recebe notificações sempre que há alterações na legislação urbanística que afetam as regiões de interesse. Mantenha-se atualizado sem esforço e evite surpresas futuras.</p>
                </div>
                <div class="col-lg-4">
                    <div class="img-placeholder">
                        <!-- Placeholder para gráfico estatístico -->
                        <span>Gráfico estatístico</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <p class="testimonial-text">
                        "O UrbanGuide virou nosso braço direito e esquerdo quando o assunto é entender o que pode ser feito em um terreno. Ele economiza tempo, evita retrabalho e nos dá a segurança de que estamos dentro da lei desde o início. É a ferramenta que todo escritório deveria ter."
                    </p>
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="/api/placeholder/50/50" alt="FG Empreendimentos" class="rounded-circle me-3">
                        <div class="text-start">
                            <h5 class="testimonial-author mb-0">Luis Eduardo Paolin</h5>
                            <p class="testimonial-position">Engenheiro Civil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="d-inline-flex align-items-center mb-4">
                        <div class="stats-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="ms-2 mb-0">CONSTRUIR COM SEGURANÇA</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-number">+ 200mil</div>
                    <p class="stat-text">consultas realizadas em fase de testes</p>
                </div>
                <div class="col-md-3">
                    <div class="stat-number">+ 5570</div>
                    <p class="stat-text">cidades com planos diretores disponíveis</p>
                </div>
                <div class="col-md-3">
                    <div class="stat-number">+ 99,9%</div>
                    <p class="stat-text">de assertividade nas informações entregues</p>
                </div>
                <div class="col-md-3">
                    <div class="stat-number">+ 850milhões</div>
                    <p class="stat-text">de hectares mapeados e prontos para consulta</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2>Menos dúvidas, mais decisões assertivas</h2>
                    <p>Com um clique, saiba o que pode ou não ser feito em qualquer endereço.</p>
                    <a href="#" class="btn btn-dark">Conheça Nossos Planos</a>
                </div>
                <div class="col-lg-6">
                    <div class="img-placeholder">
                        <!-- Placeholder para imagem de equipe -->
                        <span>Imagem da equipe</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>ESCRITÓRIO</h5>
                    <p>
                        Rua Santa Catarina, 2417<br>
                        Centro - Vitor Meireles SC<br>
                        CEP: 89148-000<br>
                        (47) 99795-7001
                    </p>
                </div>
                <div class="col-md-3">
                    <h5>INSTITUCIONAL</h5>
                    <a href="#">Início</a>
                    <a href="#">Sobre nós</a>
                    <a href="#">Planos</a>
                    <a href="#">Suporte</a>
                </div>
                <div class="col-md-3">
                    <h5>CONTATO</h5>
                    <a href="#">Whatsapp</a>
                    <a href="#">E-mail</a>
                </div>
                <div class="col-md-2">
                    <h5>AJUDA</h5>
                    <a href="#">Central de ajuda</a>
                    <a href="#">Política de privacidade</a>
                    <a href="#">Termos de uso</a>
                    <a href="#">Política de cookies</a>
                </div>
            </div>
            <div class="row footer-bottom">
                <div class="col-md-6">
                    <p>UrbanGuide © 2025<br>CNPJ 00.000.000/0001-00</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <span class="ms-3">
                        <i class="fas fa-shield-alt"></i>
                        DADOS PESSOAIS PROTEGIDOS
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Adicione aqui quaisquer funções jQuery necessárias
            
            // Exemplo: Efeito de fade para elementos ao fazer scroll
            $(window).scroll(function() {
                $('.fade-in-section').each(function() {
                    if ($(this).offset().top < $(window).scrollTop() + $(window).height() - 100) {
                        $(this).addClass('visible');
                    }
                });
            });
            
            // Exemplo: Navegação suave para links âncora
            $('a[href*="#"]').on('click', function(e) {
                e.preventDefault();
                
                $('html, body').animate(
                    {
                        scrollTop: $($(this).attr('href')).offset().top,
                    },
                    500,
                    'linear'
                );
            });
        });
    </script>
</body>
</html>