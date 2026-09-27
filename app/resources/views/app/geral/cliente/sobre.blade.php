@extends("app.geral.layouts.app",["status"=>"sobre"])

@section('diretiva')
<style>
  
  .content-box {
        background-color: white;
        border-radius: 8px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .vision-card, .ambition-card, .goal-card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: transform 0.3s ease;
    }

    .vision-card:hover, .ambition-card:hover, .goal-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .text-primary {
        color: #007bff;
    }

    .text-success {
        color: #28a745;
    }

    .text-warning {
        color: #ffc107;
    }

    .text-info {
        color: #17a2b8;
    }

    .text-muted {
        color: #6c757d;
    }

    .list-unstyled li {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .fas {
        margin-right: 10px;
    }
 











        
        .header2 {
            background: linear-gradient(to right, #2574ce, #29769c);
            color: white;
            padding: 80px 0;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header2 h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }
        .header2 p {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 40px;
        }
        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            transition: all 0.3s ease;
        }
        .content-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .content-box h3 {
            font-size: 1.8rem;
            color: #2b87f0;
            margin-bottom: 20px;
        }
        .card-img-top {
            object-fit: cover;
            height: 200px;
        }
        .card-body {
            text-align: center;
        }
        .test-button {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.2rem;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
        }
        .test-button:hover {
            background-color: #218838;
            cursor: pointer;
        }
        .testimonial {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        .testimonial .card {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .testimonial .card-body {
            text-align: center;
            padding: 30px;
        }
        .testimonial .card-title {
            font-weight: 600;
            color: #333;
            font-size: 1.4rem;
            margin-top: 15px;
        }
        .testimonial .card-text {
            font-style: italic;
            color: #555;
        }
       
        .icon {
            font-size: 1.8rem;
            margin-right: 10px;
            color: #007bff;
        }
        .card-title, .card-text {
            font-weight: 600;
            color: #333;
        }
        .card-text {
            font-size: 1.1rem;
        }
        .content-box {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 20px;
        font-family: 'Montserrat', sans-serif;
    }

    .text-muted {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .test-button {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .test-button:hover {
        background-color: #28a745;
        transform: translateY(-5px);
    }

    .test-button i {
        margin-right: 10px;
    }

    .test-button:focus, .test-button:active {
        outline: none;
        box-shadow: none;
    }
    .custom-title {
            font-weight: 700; /* Negrito */
            font-size: 2.5rem; /* Tamanho do título */
            text-transform: uppercase; /* Letras maiúsculas */
              /* Cor escura sofisticada */
            text-align: center;
            margin-top: 50px;
            font-family: 'Montserrat', sans-serif;
        }
</style>
@endsection
@section("content")
  
<div class="header2">
    <h2 style="color: white;" class="custom-title">Bem-vindo à SANKOVA UKB</h2>
    <p>Plataforma educacional inovadora com recursos para universidades, cursos e testes de admissão.</p>
</div>

<!-- Sobre a plataforma -->
<div class="container">
    <div class="content-box">
        <h2 class="section-title">Sobre a SANKOVA UKB</h2>
        <p>A SANKOVA UKB é uma plataforma educacional digital projetada para ajudar estudantes e instituições de ensino. Através dela, os alunos podem acessar simulados, conteúdos exclusivos e materiais de estudo para se prepararem para exames de admissão e desafios acadêmicos.</p>
        <p>Com recursos interativos, como simulados que refletem provas reais, garantimos a melhor preparação para o sucesso no vestibular.</p>
    </div>

    <!-- Visão, Ambições e Metas -->
    <div class="content-box">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Visão, Ambições e Metas</h2>
            </div>
        </div>
        <div class="row">
            <!-- Visão -->
            <div class="col-md-4">
                <div class="vision-card p-4 shadow rounded">
                    <h3 class="text-success"><i class="fas fa-eye"></i> Visão</h3>
                    <p class="text-muted">Nossa visão é ser a principal plataforma educacional digital para estudantes de todas as idades, com conteúdo de qualidade e ferramentas de aprendizado inovadoras.</p>
                </div>
            </div>
    
            <!-- Ambições -->
            <div class="col-md-4">
                <div class="ambition-card p-4 shadow rounded">
                    <h3 class="text-warning"><i class="fas fa-bullseye"></i> Ambições</h3>
                    <p class="text-muted">Expandir continuamente nossa base de universidades e cursos, oferecendo recursos de aprendizado atualizados e relevantes, para que os alunos se preparem de forma eficaz para exames de admissão e muito mais.</p>
                </div>
            </div>
    
            <!-- Metas -->
            <div class="col-md-4">
                <div class="goal-card p-4 shadow rounded">
                    <h3 class="text-info"><i class="fas fa-trophy"></i> Metas</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-success"></i> Aumentar a quantidade de universidades e cursos parceiros anualmente.</li>
                        <li><i class="fas fa-check-circle text-success"></i> Oferecer mais de 10.000 simulados de testes de admissão por ano.</li>
                        <li><i class="fas fa-check-circle text-success"></i> Expandir os recursos interativos, como fóruns de discussão, chats ao vivo e aulas de revisão.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content-box p-5 shadow-lg rounded bg-light">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h2 class="section-title">Oportunidades de Testes Simulados</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <p class="text-muted">Prepare-se para os exames de admissão com nossos simulados baseados em provas reais. A cada simulado, os alunos podem testar seus conhecimentos e avaliar seu desempenho antes do grande dia.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <a href="/ajuda/simulado" class="test-button btn  btn-lg px-4 py-2 rounded-pill shadow-sm" style="background-color: #23502d;color:white;"><i class="fa fa-play-circle"></i> Comece seu Teste Simulado Agora</a>
            </div>
        </div>
    </div>


 
</div>


@endsection