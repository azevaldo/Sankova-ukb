@extends("app.geral.layouts.app",["status"=>"uni"])

@section('diretiva')
<style>
  .faculdade-header {
      background: linear-gradient(to right, #007bff, #00c6ff);
      color: white;
      padding: 30px 15px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  }
  .curso-card {
      transition: transform 0.3s ease-in-out;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15);
      background: #ffffff;
      position: relative;
      padding: 20px;
      text-align: center;
  }
  .curso-card:hover {
      transform: scale(1.03);
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  }
  .curso-icon {
      font-size: 50px;
      color: #007bff;
      margin-bottom: 10px;
  }
  .curso-info h5 {
      font-weight: bold;
      color: #007bff;
      font-size: 16px;
  }
  .curso-info p {
      color: #555;
      font-size: 13px;
  }
  .curso-btn {
      background: #007bff;
      color: white;
      border-radius: 15px;
      padding: 6px 12px;
      font-size: 12px;
  }
 .curso-btn:hover {
    color: white;
      background: #0056b3;
  }
  .btn-simulado {
        display: inline-block;
        background-color: #007bff; /* Azul vibrante */
        color: white;
        font-size: 18px;
        font-weight: bold;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .btn-simulado:hover {
        background-color: #0056b3; /* Azul mais escuro no hover */
        transform: scale(1.05);
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
        color: white;
    }
</style>
@endsection

@section("content")
  
<div class="container mt-5">
  <!-- Seção Detalhes da Faculdade -->
  <div class="faculdade-header shadow">
      <h2 id="nome-faculdade" style="color: white">Faculdade : {{$faculdade->nome}}</h2>
      <h5 id="universidade" style="color: white">Universidade : {{$faculdade->universidade->nome}}</h5>
      <p id="descricao" style="color: white;text-align:justify;text-indent:10px">Descrição : {{$faculdade->descricao}}...</p>
  </div>
  <a href="{{route('universidade.detalhes',$faculdade->universidade->id)}}" class="btn-simulado mt-3">
    Voltar
</a>
  <!-- Seção Cursos -->
  <h4 class="mt-5 text-center">Cursos Disponíveis</h4>
  <div class="row mt-3">
    @if($faculdade->cursos->isEmpty())
    <div class="alert alert-danger">
        Não há Cursos cadastradas para esta faculdade.
    </div>
                @else
      @foreach($cursos as $curso)
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
          <div class="card curso-card">
              <i class="fas fa-laptop-code curso-icon"></i>
              <div class="curso-info">
                  <h5>{{$curso->nome}}</h5>
                  <p>Inovação...</p>
                  <a href="{{route('curso.detalhes',$curso->id)}}" class="btn curso-btn">Saiba Mais</a>
              </div>
          </div>
      </div>
      @endforeach
      {{$cursos->links('vendor.pagination.bootstrap-5')}}
      @endif
  </div>
</div>

@endsection