@extends("app.geral.layouts.app",["status"=>"diversos"])

@section('diretiva')
<style>
    .question-card {
        background-color: #ffffff;
        border-radius: 8px;
        margin-bottom: 20px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .question-card .question-title {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }
    .option-btn {
        margin-top: 10px;
    }
    .btn-answered {
        background-color: #28a745;
        color: white;
    }
    .btn-incorrect {
        background-color: #dc3545;
        color: white;
    }
    
    .options {
        display: block;
        margin-top: 10px;
    }
    .btn-voltar {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-voltar:hover {
        background-color: #0056b3;
        color: white;
    }

    .btn-voltar:active {
        background-color: #003f7f;
    }
    
</style>
</style>
@endsection

@section('content')

<div class="container">
    <div class="text-center mt-4">
        <div class="mb-3">
            <img src="{{ asset('inse/republica.png') }}" alt="Insígnia da República" style="width: 80px; height: auto;">
        </div>
        <h2 class="fw-bold text-uppercase text-dark" style="font-size: 1.5rem;">
            {{$simulado->curso->faculdade->universidade->nome}}
        </h2>
        <h3 class="text-muted" style="font-size: 1.3rem;">
            {{$simulado->curso->faculdade->nome}}
        </h3>
        <h3 class="text-primary fw-bold mt-3" style="font-size: 1.4rem;">
            Prova Online - {{$simulado->curso->nome}}
        </h3>
        <hr style="border: 1px solid black; width: 80%; margin: 20px auto;">
    </div>
    <a href="javascript:history.back()" class="btn-voltar mb-3">Voltar</a>
    <div id="examContainer">
        @foreach($disciplinasValidas as $disciplina)
        <div class="question-card" id="disciplina{{$disciplina->id}}">
            <div class="question-title"> {{$disciplina->disciplina}}</div>
    
            @foreach($disciplina->questoes->where('simulado_id', $simulado->id) as $index => $questao)
                <div class="question" id="questao{{$questao->id}}">
                    <p><strong>Pergunta {{$index + 1}}:</strong> {!! $questao->texto !!}</p>
    
                    @foreach($questao->alternativas as $altIndex => $alternativa)
                        <label class="options">
                            <div>Opção {{$altIndex + 1}}: {!! $alternativa->texto !!} 
                                @if($alternativa->correta)
                                    (<span style="background-color: #28a745; color: white;">Correto</span>)
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endforeach
    
    </div>
  
    

</div>
 

@endsection
