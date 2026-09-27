@extends("app.office.layouts.templete")






@section('diretiva')
<style>
   
        /* Estilo do fundo do modal */
         /* Estilo do fundo do modal */
         .modal {
            display: none;
            position: fixed; 
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        /* Estilo do conteúdo do modal */
        .modal-content {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            text-align: center;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        /* Animação de Fade-in */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .modal-content h2 {
            color: #8f243f;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .modal-content p {
            color: #333;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .modal-content .icon {
            font-size: 50px;
            color: #ff9800;
            margin-bottom: 20px;
        }

        /* Estilo do botão de fechar */
        .close-btn {
            background-color: #8f243f;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .close-btn:hover {
            background-color: #943945;
            color: white;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .modal-content {
                width: 80%;
                padding: 20px;
            }
        }
</style>
@section('diretiva')
<style>
    body { background-color: #f8f9fa; color: #333; }
    .container { max-width: 800px; }
    .editable { border: 1px solid #ccc; padding: 5px; min-height: 30px; background-color: white; display: inline-block; width: 75%; }
    .delete-btn { cursor: pointer; color: red; margin-left: 5px; }
</style>
@endsection

@section("content")
<div class="text-center mt-4">
    <div class="mb-3">
        <img src="{{ asset('inse/republica.png') }}" alt="Insígnia da República" style="width: 80px; height: auto;">
    </div>
    <h2 class="fw-bold text-uppercase text-dark" style="font-size: 1.5rem;">
        {{$curso->faculdade->universidade->nome}}
    </h2>
    <h3 class="text-muted" style="font-size: 1.3rem;">
        {{$curso->faculdade->nome}}
    </h3>
    <h3 class="text-primary fw-bold mt-3" style="font-size: 1.4rem;">
        Criar Teste de  - {{$curso->nome}}
    </h3>
    <hr style="border: 1px solid black; width: 80%; margin: 20px auto;">
</div>
<div class="d-flex justify-content-center gap-2 mt-4">
    <a class="btn   btn-sm cabeca2"    href="{{route('curso.index2',$curso->faculdade->id)}}">Voltar Para Cursos</a>
</div>
@if($disciplinas->isEmpty())
    <div  class="alert" style="background-color: rgb(128, 42, 42);color:white">
        Não Existe Disciplinas Nesse Curso
    </div>
@else
<div class="container mt-4">
    <form id="examForm" action="{{route('simulado.store')}}" method="POST" onsubmit="return validateAndPrepareData(event)">
        @csrf
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
        <input type="hidden" name="dados" id="dados" required>

        @foreach ($disciplinas as $disciplina)
            <div class="mt-3 border p-3 bg-light">
                <label class="form-label">Disciplina:</label>
                <input type="text" class="form-control" value="{{ $disciplina->disciplina }}" readonly>
                <input type="hidden" name="disciplinas[]" value="{{ $disciplina->id }}">
                <div id="questionsContainer{{ $disciplina->id }}"></div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addQuestion({{ $disciplina->id }})">Adicionar Pergunta</button>
            </div>
        @endforeach
        
        <button type="submit" class="btn btn-success mt-3">Salvar Prova</button>
    </form>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="icon">&#x26A0;</div> <!-- Ícone de aviso -->
            <h2>Atenção!</h2>
            <p id="alerta"></p>
            <button class="close-btn" id="closeBtn">Fechar</button>
        </div>
</div>
</div>

@endif

<script>
let subjects = {};

function initializeSubjects(disciplinas) {
    disciplinas.forEach(disciplinaId => {
        if (!subjects[disciplinaId]) {
            subjects[disciplinaId] = [];
        }
        if (subjects[disciplinaId].length === 0) {
            addQuestion(disciplinaId); // Garante que cada disciplina tenha pelo menos uma pergunta inicial
        }
    });
}

function addQuestion(disciplinaId) {
    if (!subjects[disciplinaId]) {
        subjects[disciplinaId] = [];
    }
    
    let questionIndex = subjects[disciplinaId].length;
    subjects[disciplinaId].push({ text: '', options: [], correct: -1 });

    let questionDiv = document.createElement('div');
    questionDiv.classList.add('mt-2', 'border', 'p-2', 'bg-white', 'position-relative');
    questionDiv.setAttribute("id", `question-${disciplinaId}-${questionIndex}`);
    questionDiv.innerHTML = `
        <label>Pergunta:</label>
        <div contenteditable="true" class="editable" oninput="updateQuestion(${disciplinaId}, ${questionIndex}, this)"></div>
        <span class="delete-btn" onclick="removeQuestion(${disciplinaId}, ${questionIndex})" style="color:red;">x</span>
        <div id="optionsContainer${disciplinaId}-${questionIndex}"></div>
        <button type="button" class="btn btn-sm btn-info mt-2" onclick="addOption(${disciplinaId}, ${questionIndex})">Adicionar Opção</button>
    `;

    document.getElementById(`questionsContainer${disciplinaId}`).appendChild(questionDiv);

    // Adiciona apenas duas opções inicialmente
    addOption(disciplinaId, questionIndex);
    addOption(disciplinaId, questionIndex);
}

function removeQuestion(disciplinaId, questionIndex) {
    if (subjects[disciplinaId].length > 1) {
        subjects[disciplinaId].splice(questionIndex, 1);
        document.getElementById(`question-${disciplinaId}-${questionIndex}`).remove();
    } else {
        document.getElementById('alerta').innerHTML="Cada disciplina deve ter pelo menos uma pergunta."
        document.getElementById('myModal').style.display = 'flex';
    }
}

function updateQuestion(disciplinaId, questionIndex, element) {
    subjects[disciplinaId][questionIndex].text = element.innerHTML;
}

function addOption(disciplinaId, questionIndex) {
  //  if (subjects[disciplinaId][questionIndex].options.length >= 5) {
    //    alert("Máximo de 5 opções por pergunta!");
      //  return;
   // }

    let optionIndex = subjects[disciplinaId][questionIndex].options.length;
    subjects[disciplinaId][questionIndex].options.push('');

    let optionDiv = document.createElement('div');
    optionDiv.setAttribute("id", `option-${disciplinaId}-${questionIndex}-${optionIndex}`);
    optionDiv.innerHTML = `
        <input type="radio" name="correct${disciplinaId}-${questionIndex}" onclick="setCorrect(${disciplinaId}, ${questionIndex}, ${optionIndex})" required>
        <div contenteditable="true" class="editable" oninput="updateOption(${disciplinaId}, ${questionIndex}, ${optionIndex}, this)"></div>
        <span class="delete-btn" onclick="removeOption(${disciplinaId}, ${questionIndex}, ${optionIndex})" style="color:red;">x</span>
    `;

    document.getElementById(`optionsContainer${disciplinaId}-${questionIndex}`).appendChild(optionDiv);
}

function removeOption(disciplinaId, questionIndex, optionIndex) {
    let options = subjects[disciplinaId][questionIndex].options;

    if (options.length > 2) {
        options.splice(optionIndex, 1);
        document.getElementById(`option-${disciplinaId}-${questionIndex}-${optionIndex}`).remove();
    } else {
        document.getElementById('alerta').innerHTML="Cada pergunta deve ter pelo menos duas opções.";
        document.getElementById('myModal').style.display = 'flex';
         
    }
}

function updateOption(disciplinaId, questionIndex, optionIndex, element) {
    subjects[disciplinaId][questionIndex].options[optionIndex] = element.innerHTML;
}

function setCorrect(disciplinaId, questionIndex, optionIndex) {
    subjects[disciplinaId][questionIndex].correct = optionIndex;
}

function validateAndPrepareData(event) {
    document.getElementById('dados').value = JSON.stringify(subjects);
    return true;
}

// Chamada automática para inicializar perguntas ao carregar a página
document.addEventListener("DOMContentLoaded", function() {
    let disciplinasIds = @json($disciplinas->pluck('id')); // Pega os IDs das disciplinas
    initializeSubjects(disciplinasIds);
});
      // Fechar o modal ao clicar fora da caixa de conteúdo
      document.getElementById("myModal").onclick = function(event) {
        if (event.target === document.getElementById("myModal")) {
            document.getElementById("myModal").style.display = "none";
        }};
        // Fechar modal
        document.getElementById("closeBtn").addEventListener("click", function () {
            document.getElementById("myModal").style.display = "none";
        });
    
    
</script>
@endsection