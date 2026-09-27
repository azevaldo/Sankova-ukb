@extends("app.geral.layouts.app",["status"=>"uni"])

@section('diretiva')
<style>
  body {
      background: #f8f9fa;
  }
  .curso-header {
      background: linear-gradient(to right, #007bff, #00c6ff);
      color: white;
      padding: 40px 20px;
      text-align: center;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
  }
  .info-box {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }
  .accordion-button {
      font-weight: bold;
      color: #007bff;
  }
  .accordion-body {
      background: #f1f1f1;
      border-radius: 8px;
  }
  .tema-item {
      padding: 10px;
      cursor: pointer;
      background: #e9ecef;
      border-radius: 8px;
      margin-bottom: 5px;
  }
  .tema-item:hover {
      background: #d6d8db;
  }
  .subtema-item {
      padding: 8px;
      margin-left: 20px;
      background: #f8f9fa;
      border-radius: 6px;
  }
  .conteudo-link {
      display: block;
      margin-left: 40px;
      color: #007bff;
      text-decoration: none;
  }
  .conteudo-link:hover {
      text-decoration: underline;
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
  <!-- Seção Detalhes do Curso -->
  <div class="curso-header" >
      <h2 id="nome-curso" style="color: white">Curso : {{$curso->nome}}</h2>
      <h5 id="faculdade" style="color: white">Faculdade : {{$curso->faculdade->nome}}</h5>
      <h6 id="universidade" style="color: white">Universidade  : {{$curso->faculdade->universidade->nome}} </h6>
      <p id="duracao" style="color: white">Duração: {{$curso->duracao}}  anos</p>
  </div>

  <div class="info-box mb-4">
      <h5>Descrição do Curso</h5>
      <p id="descricao" style="text-align: justify;text-indent:10px">{{$curso->descricao}}.</p>
  </div>
  <div>
    <a href="{{route('faculdade.detalhes',$curso->faculdade->id)}}" class="btn-simulado">
         Voltar
    </a>
    @if(!($curso->simulados->isEmpty()))
    <a href="{{ route('simulado.gerar', $curso->id) }}" class="btn-simulado">
        🎯 Gerar Simulado
    </a>
    
    @endif
  </div>
  <!-- Seção Disciplinas -->
  <h4 class="text-center">Disciplinas do Curso</h4>
  <div class="accordion mb-5" id="disciplinasAccordion">
      <!-- Primeira Disciplina -->


      @if($curso->disciplinas->isEmpty())
      <div class="alert alert-danger">
          Não há Disciplinas cadastradas para este curso.
      </div>
                  @else

      @foreach($curso->disciplinas as $disciplina)
      <div class="accordion-item">
          <h2 class="accordion-header" id="heading1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#disciplina{{$disciplina->id}}">
                {{$disciplina->disciplina}}
              </button>
          </h2>
          <div id="disciplina{{$disciplina->id}}" class="accordion-collapse collapse" data-bs-parent="#disciplinasAccordion">
              <div class="accordion-body">
                @foreach($disciplina->topicos as $topico)
                  <div class="tema-item" onclick="toggle('tema{{$topico->id}}')">{{$topico->tema}}</div>
                  <div id="tema{{$topico->id}}" style="display: none;">
                      
                    @foreach($topico-> materialEstudos as $material)
                      <div class="subtema-item" onclick="toggle('subtema{{$material->id}}')">{{$material->subtema}}</div>
                      <div id="subtema{{$material->id}}" style="display: none;">
                          <a href="/materials/{{$material->doc}}" target="_blank" class="conteudo-link">Acessar Material</a>
                      </div>
                      @endforeach
                     
                  </div>
                  @endforeach
                 


              </div>
          </div>
      </div>
      
@endforeach
@endif
  </div>
</div>

<script>
  function toggle(id) {
      var elemento = document.getElementById(id);
      if (elemento.style.display === "none") {
          elemento.style.display = "block";
      } else {
          elemento.style.display = "none";
      }
  }
</script>


@endsection