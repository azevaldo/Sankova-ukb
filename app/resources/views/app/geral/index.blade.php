@extends("app.geral.layouts.app",["status"=>"index"])

@section("content")
  
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="/principal/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative">

        <!-- Boas-vindas -->
        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
            <h2>SEJA BEM-VINDO À SANKOVA UKB</h2>
            <p>A plataforma que reúne universidades, faculdades, cursos e materiais para testes de admissão.</p>
        </div>
        <!-- Fim Boas-vindas -->
    
        <div class="content row gy-4">
            <!-- Seção de Por que Escolher a UKB Store -->
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                    <h3>Por que escolher a SANKOVA UKB?</h3>
                    <p>
                        A SANKOVA UKB centraliza informações sobre universidades e faculdades, oferecendo materiais atualizados para os testes de admissão. 
                        Nossa plataforma facilita o acesso a conteúdos essenciais para candidatos e estudantes.
                    </p>
                    <div class="text-center">
                        <a href="/sobre" class="more-btn"><span>Saiba Mais</span> <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Fim Seção de Por que Escolher a UKB Store -->
    
            <!-- Seção de Destaques -->
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="d-flex flex-column justify-content-center">
                    <div class="row gy-4">
    
                        <!-- Universidades Cadastradas -->
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                <i class="bi bi-bank"></i>
                                <h4>Universidades Registradas</h4>
                                <p>Explore uma lista completa de universidades e suas respectivas faculdades.</p>
                            </div>
                        </div>
                        <!-- Fim Universidades Cadastradas -->
    
                        <!-- Cursos Disponíveis -->
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                <i class="bi bi-book"></i>
                                <h4>Cursos Disponíveis</h4>
                                <p>Encontre detalhes sobre os cursos oferecidos por cada faculdade.</p>
                            </div>
                        </div>
                        <!-- Fim Cursos Disponíveis -->
    
                        <!-- Materiais de Teste de Admissão -->
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                <i class="bi bi-file-earmark-text"></i>
                                <h4>Materiais para Testes</h4>
                                <p>Acesse materiais essenciais para se preparar para os exames de admissão.</p>
                            </div>
                        </div>
                        <!-- Fim Materiais de Teste de Admissão -->
    
                    </div>
                </div>
            </div>
            <!-- Fim Seção de Destaques -->
        </div>
        <!-- Fim Conteúdo -->
    
    </div>
    

    </section><!-- /Hero Section -->


    <div class="container py-5">
      <h2 class="text-center mb-4">Principais Universidades</h2>
      <div class="row g-4">
  
          <!-- Lado Esquerdo (Informações sobre a Plataforma) -->
          <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <h4 class="text-center mb-3">Funcionalidades Essenciais</h4>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-search fa-lg text-primary me-3"></i>
                        <span>Pesquisa Avançada</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-chart-line fa-lg text-primary me-3"></i>
                        <span>Monitoramento De Progresso</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-file-alt fa-lg text-primary me-3"></i>
                        <span>Fornecimento de Conteúdos</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-graduation-cap fa-lg text-primary me-3"></i>
                        <span>Fornecimento de Simulados</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-plus-circle fa-lg text-primary me-3"></i>
                        <span>Entre Outras Funcionalidades</span>
                    </li>
                    <a href="{{route('universidades.all')}}" class="btn btn-outline-primary btn-sm rounded-3 px-4 py-2">
                        Lista de universidades
                    </a>
                </ul>
            </div>
          </div>
          

  
          <!-- Lado Direito (Universidades) -->
          <div class="col-md-8">
              <div class="row g-4">
                @foreach($universidades->take(4) as $universidade)
                  <!-- Universidade 1 -->
                  <div class="col-md-6 col-lg-3">
                    <a href="{{route('universidade.detalhes',$universidade->id)}}">
                      <div class="card university-card text-center p-3 shadow-sm border-0 hover-effect">
                        <i class="fas fa-university fa-2x text-primary mb-3"></i>
                        <div class="card-body">
                            <h5 class="card-title mb-2">{{$universidade->sigla}}</h5>
                            <div class="university-info">
                              <p class="text-muted mb-3"><strong>Provincia:</strong> <span class="text-info"> {{$universidade->municipio->provincia->provincia}}</span></p>
                            
                            </div>
                            <a href="{{route('universidade.detalhes',$universidade->id)}}"   class="btn btn-outline-primary btn-sm rounded-3 px-4 py-2">Ver detalhes</a>
                        </div>
                    </div>
                    </a>
                      
                  </div>
                  @endforeach
  
                  <!-- Universidade 2 -->
               
  
                
  
                  <!-- Universidade 4 -->
   
         
          
              </div>
          </div>
      </div>
  </div>
  

    














 
    
    
 <!-- Seção de Estatísticas -->
<section id="stats" class="stats section light-background">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
        <i class="fa-solid fa-university"></i>
        <div class="stats-item">
          <span data-purecounter-start="0" data-purecounter-end="{{$nUniversidades}}" data-purecounter-duration="1" class="purecounter"></span>
          <p>Número de Universidades</p>
        </div>
      </div><!-- Fim do Item de Estatísticas -->

      <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
        <i class="fa-solid fa-building-columns"></i>
        <div class="stats-item">
          <span data-purecounter-start="0" data-purecounter-end="{{$nFaculdades}}" data-purecounter-duration="1" class="purecounter"></span>
          <p>Número de Faculdades</p>
        </div>
      </div><!-- Fim do Item de Estatísticas -->

      <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
        <i class="fa-solid fa-book"></i>
        <div class="stats-item">
          <span data-purecounter-start="0" data-purecounter-end="{{$nCursos}}" data-purecounter-duration="1" class="purecounter"></span>
          <p>Número de Cursos</p>
        </div>
      </div><!-- Fim do Item de Estatísticas -->

      <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
        <i class="fa-solid fa-users"></i>
        <div class="stats-item">
          <span data-purecounter-start="0" data-purecounter-end="{{$nUsuarios}}" data-purecounter-duration="1" class="purecounter"></span>
          <p>Número de Estudantes</p>
        </div>
      </div><!-- Fim do Item de Estatísticas -->

    </div>

  </div>

</section><!-- /Seção de Estatísticas -->



 <!-- Seção de Serviços -->
<section id="services" class="services section">

  <!-- Título da Seção -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Serviços</h2>
    <p>Oferecemos soluções inovadoras para a gestão acadêmica e preparação de exames.</p>
  </div><!-- Fim do Título da Seção -->

  <div class="container">

    <div class="row gy-4">

      <!-- Gestão de Usuários -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a   class="stretched-link">
            <h3>Gestão de Usuários</h3>
          </a>
          <p>Gerenciamos facilmente estudantes, professores e administradores, controlando permissões e acessos de forma eficiente.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

      <!-- Fornecimento de Conteúdos -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-book-open"></i>
          </div>
          <a   class="stretched-link">
            <h3>Fornecimento de Conteúdos</h3>
          </a>
          <p>Disponibilizamos materiais de estudo, resumos e conteúdos interativos para preparar os estudantes para os exames de admissão.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

      <!-- Testes Simulados -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-vial"></i>
          </div>
          <a  class="stretched-link">
            <h3>Testes Simulados</h3>
          </a>
          <p>Oferecemos simulados de exames de admissão com questões práticas para testar o conhecimento dos candidatos e prepará-los melhor.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

      <!-- Recomendações de Cursos -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <a  class="stretched-link">
            <h3>Recomendações de Cursos</h3>
          </a>
          <p>Com base no perfil do aluno, sugerimos cursos que se alinham com suas habilidades e interesses, ajudando-os a tomar decisões mais informadas.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

      <!-- Suporte Personalizado -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-headset"></i>
          </div>
          <a  class="stretched-link">
            <h3>Suporte Personalizado</h3>
          </a>
          <p>Oferecemos suporte individualizado para alunos e professores, ajudando a resolver questões técnicas ou acadêmicas de maneira rápida e eficaz.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

      <!-- Monitoramento de Progresso -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <a  class="stretched-link">
            <h3>Monitoramento de Progresso</h3>
          </a>
          <p>Acompanhe o desempenho dos alunos em tempo real, gerando relatórios de progresso e identificando áreas que precisam de atenção.</p>
        </div>
      </div><!-- Fim do Item de Serviço -->

    </div>

  </div>

</section><!-- /Seção de Serviços -->

 

 

 <!-- Seção de Testemunhos -->
<section id="testimonials" class="testimonials section">

  <div class="container">

    <div class="row align-items-center">

      <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
        <h3>O que dizem sobre nós</h3>
        <p>
          Nossa plataforma tem sido essencial para estudantes que desejam se preparar para os testes de admissão. Veja alguns depoimentos de quem já utilizou nossos materiais e alcançou bons resultados.
        </p>
      </div>

      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                   <div>
                    <h3>Lucas Almeida</h3>
                    <h4>Estudante aprovado</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Com os materiais da plataforma, consegui me preparar melhor para o teste de admissão e fui aprovado! O conteúdo é muito organizado e atualizado.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- Fim do depoimento -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                   <div>
                    <h3>Ana Clara</h3>
                    <h4>Futura universitária</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>A plataforma me ajudou a revisar os principais conteúdos que caem nos testes de admissão. Foi fundamental para minha preparação.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- Fim do depoimento -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                  <div>
                    <h3>João Mendes</h3>
                    <h4>Estudante</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Os simulados e questões comentadas foram essenciais para entender melhor os conteúdos e ganhar confiança para o teste.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- Fim do depoimento -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="d-flex">
                   <div>
                    <h3>Mariana Ferreira</h3>
                    <h4>Aprovada no teste</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Graças à plataforma, consegui revisar de forma eficiente e passei no teste de admissão. Super recomendo para quem quer se preparar bem!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- Fim do depoimento -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </div>

  </div>

</section><!-- /Seção de Testemunhos -->

@endsection