@extends("app.geral.layouts.app",["status"=>"diversos"])
@section('diretiva')
<style>
    /* Efeito Hover */
    .hover-effect:hover {
        transform: translateY(-10px); /* Move o card para cima */
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
        transition: all 0.3s ease-in-out; /* Suaviza a animação */
    }

    .hover-effect .card-body {
        transition: color 0.3s ease; /* Animação da cor do texto */
    }

    .hover-effect:hover .card-body h5 {
        color: #007bff; /* Muda a cor do título */
    }

    .hover-effect:hover .btn-outline-primary {
        background-color: #007bff; /* Muda o fundo do botão */
        color: white; /* Cor do texto do botão */
    }
</style>
@endsection
@section('content')
    <!-- Seção de Contato -->
    <section id="contact" class="contact section">

        <!-- Título da Seção -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Contato</h2>
          <p>Entre em contato conosco para qualquer dúvida ou informação adicional.</p>
        </div><!-- Fim do Título da Seção -->
  
        <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15888.24929347375!2d13.39959745!3d-12.5762619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1bb1977c49b6a9e1%3A0xa1c07b3c3a74e6e9!2sBenguela!5e0!3m2!1spt-BR!2sao!4v1700000000000" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- Fim do Google Maps -->
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row gy-4">
  
            <div class="col-lg-4">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Localização</h3>
                  <p>Rua Principal, Centro da Cidade, Benguela, Angola</p>
                </div>
              </div><!-- Fim do Item de Informação -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Telefone</h3>
                  <p>+244 938 531 896</p>
                </div>
              </div><!-- Fim do Item de Informação -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email</h3>
                  <p>contato@empresa.co.ao</p>
                </div>
              </div><!-- Fim do Item de Informação -->
  
            </div>
  
            <div class="col-lg-8">
              <form action="" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row gy-4">
  
                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Seu Nome" required>
                  </div>
  
                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Seu Email" required>
                  </div>
  
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Assunto" required>
                  </div>
  
                  <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Sua Mensagem" required></textarea>
                  </div>
  
                  <div class="col-md-12 text-center">
                    <div class="loading">Carregando...</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>
  
                    <button type="submit">Enviar Mensagem</button>
                  </div>
  
                </div>
              </form>
            </div><!-- Fim do Formulário de Contato -->
  
          </div>
  
        </div>
  
      </section><!-- /Seção de Contato -->
@endsection