@extends("app.geral.layouts.app",["status"=>"uni"])

@section('diretiva')
<style>
  /* Fundo do Cabeçalho */
  .hero-section {
      background: linear-gradient(120deg, #007bff, #004085);
      color: white;
      padding: 60px 20px;
      text-align: center;
  }
  .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
  }
  .hero-section p {
      font-size: 1.2rem;
      opacity: 0.9;
  }
  /* Área de Detalhes */
  .details-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease-in-out;
  }
  .details-box:hover {
      transform: scale(1.02);
  }
  .icon-circle {
      background: #007bff;
      color: white;
      padding: 12px;
      border-radius: 50%;
      font-size: 1.5rem;
  }
  /* Lista de Faculdades */
  .faculties-section {
      margin-top: 40px;
  }
  .faculty-card {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s;
      border: none;
      border-radius: 12px;
      background: #f8f9fa;
      text-align: center;
      padding: 20px;
  }
  .faculty-card:hover {
      transform: scale(1.05);
      background: #e9ecef;
  }
  .faculty-icon {
      font-size: 2.5rem;
      color: #007bff;
      margin-bottom: 10px;
  }
  /* Botões */
  .btn-custom {
      background: #007bff;
      color: white;
      border-radius: 25px;
      padding: 6px 15px;
      font-size: 0.9rem;
  }
  .btn-custom:hover {
      background: #0056b3;
      color: white;
  }
</style>
@endsection
@section("content")  <!-- SEÇÃO PRINCIPAL -->
<div  class="hero-section">
    <h1 style="color: white;">{{$universidade->nome}}</h1>
    <p>Excelência Acadêmica e Inovação para o Futuro</p>
</div>

<div class="container mt-5">
    <div class="row">
        <!-- DETALHES DA UNIVERSIDADE -->
        <div class="col-lg-8">
            <div class="details-box">
                <h3 class="text-center mb-4">📍 Informações da Universidade</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-university icon-circle"></i> <strong>Nome:</strong>{{$universidade->nome}}</p>
                        <p style="text-align: justify"><i class="fas fa-map-marker-alt icon-circle"></i> <strong>Endereço:</strong>{{$universidade->endereco}}</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-globe icon-circle"></i> <strong>Província:</strong>{{$universidade->municipio->provincia->provincia}}</p>
                        <p><i class="fas fa-city icon-circle"></i> <strong>Município:</strong> {{$universidade->municipio->municipio}}</p>
                    </div>
                </div>
                <p class="mt-3" style="text-align: center"><i class="fas fa-book icon-circle"></i><strong>Descrição</strong></p>
                <p class="mt-3" style="text-align: justify;text-indent:15px">{{$universidade->descricao}}.</p>
                <div class="text-center mt-3">
                    <a href="{{$universidade->site}}" target="_blank" class="btn btn-custom"><i class="fas fa-globe"></i> Site Oficial</a>
                    <a href="mailto:{{$universidade->email}}" class="btn btn-custom"><i class="fas fa-envelope"></i> Contato</a>
                </div>
            </div>
        </div>

        <!-- OUTRAS INFORMAÇÕES RELEVANTES (à direita) -->
        <div class="col-lg-4">
            <div class="details-box">
                <h3 class="text-center mb-4">🌐 Outras Informações</h3>
                <ul>
                    <li><strong>Fundação:</strong> indefinido</li>
                    <li><strong>Alunos:</strong> Indefinido</li>
                    <li><strong>Programas:</strong> Indefinido</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- LISTA DE FACULDADES -->
    <div class="faculties-section mb-5" >
        <h3 class="text-center mb-4">🎓 Faculdades Disponíveis</h3>
        <div class="row">
            @if($faculdades->isEmpty())
<div class="alert alert-danger">
    Não há faculdades cadastradas para esta universidade.
</div>
            @else
          @foreach($faculdades as $faculdade)
            <div class="col-md-4 mt-4">
                <div class="card faculty-card">
                    <i class="fas fa-laptop-code faculty-icon"></i>
                    <h5>{{$faculdade->nome}}</h5>
                    <p>Inovação e tecnologia</p>
                    <a href="{{route('faculdade.detalhes',$faculdade->id)}}" class="btn btn-custom">Saiba Mais</a>
                </div>
            </div>
          @endforeach
          {{$faculdades->links('vendor.pagination.bootstrap-5')}}
            @endif
     
 
 
 
        </div>

       
    </div>
</div>

@endsection