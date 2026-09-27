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
        Editar Teste de  - {{$curso->nome}}
    </h3>
    <hr style="border: 1px solid black; width: 80%; margin: 20px auto;">
</div>
<div class="d-flex justify-content-center gap-2 mt-4">
    <a class="btn   btn-sm cabeca2"   href="{{ route('simulado.listar', $curso->id) }}">Voltar Para Simulados</a>
</div>
<div class="container mt-4">
    <form id="examForm" action="{{ route('simulado.update', $simulado->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="curso_id" value="{{ $simulado->curso_id }}">
        <input type="hidden" name="dados" id="dados" required>

        @foreach ($disciplinas as $disciplina)
            <div class="mt-3 border p-3 bg-light">
                <label class="form-label">Disciplina:</label>
                <input type="text" class="form-control" value="{{ $disciplina->disciplina }}" readonly>
                <input type="hidden" name="disciplinas[]" value="{{ $disciplina->id }}">
                
                <div id="questionsContainer{{ $disciplina->id }}">
                    @if(isset($questoesFormatadas[$disciplina->id]))
                        @foreach ($questoesFormatadas[$disciplina->id] as $questao)
                            <div class="mt-2 border p-2 bg-white position-relative question-block" data-disciplina="{{ $disciplina->id }}" data-questao="{{ $questao['id'] }}">
                                <label>Pergunta:</label>
                                <div contenteditable="true" class="editable question-text">{!! $questao['text'] !!}</div>
                                <span class="delete-btn" onclick="removeQuestion(this)"style="color: red">x</span>
                                
                                <div class="options-container">
                                    @foreach ($questao['options'] as $index => $option)
                                        <div class="option-block">
                                            <input type="radio" class="correct-option" name="correct{{ $disciplina->id }}-{{ $questao['id'] }}" {{ $option == $questao['correct'] ? 'checked' : '' }}>
                                            <div contenteditable="true" class="editable option-text">{!! $option !!}</div>
                                            <span class="delete-btn" onclick="removeOption(this)" style="color: red">x</span>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <button type="button" class="btn btn-sm btn-info mt-2 add-option">Adicionar Opção</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                <button type="button" class="btn btn-secondary mt-2 add-question">Adicionar Pergunta</button>
            </div>
        @endforeach
        
        <button type="submit" class="btn btn-success mt-3" onclick="prepareData()">Salvar Alterações</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".add-question").forEach(button => {
            button.addEventListener("click", function () {
                let disciplinaId = this.parentElement.querySelector("input[name='disciplinas[]']").value;
                addQuestion(disciplinaId);
            });
        });

        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("add-option")) {
                let questionBlock = event.target.closest(".question-block");
                addOption(questionBlock);
            }
            if (event.target.classList.contains("correct-option")) {
                setCorrect(event.target);
            }
        });
    });

    function addQuestion(disciplinaId) {
        let container = document.getElementById("questionsContainer" + disciplinaId);
        let questionId = Date.now();
        let questionHTML = `
            <div class="mt-2 border p-2 bg-white position-relative question-block" data-disciplina="${disciplinaId}" data-questao="${questionId}">
                <label>Pergunta:</label>
                <div contenteditable="true" class="editable question-text">Nova Pergunta</div>
                <span class="delete-btn" onclick="removeQuestion(this)"style="color:red;">x</span>
                <div class="options-container">
                    <div class="option-block">
                        <input type="radio" class="correct-option" name="correct${disciplinaId}-${questionId}">
                        <div contenteditable="true" class="editable option-text">Opção 1</div>
                        <span class="delete-btn" onclick="removeOption(this)"style="color:red;">x</span>
                    </div>
                    <div class="option-block">
                        <input type="radio" class="correct-option" name="correct${disciplinaId}-${questionId}">
                        <div contenteditable="true" class="editable option-text">Opção 2</div>
                        <span class="delete-btn" onclick="removeOption(this)" style="color:red;">x</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-info mt-2 add-option">Adicionar Opção</button>
            </div>`;
        container.insertAdjacentHTML("beforeend", questionHTML);
    }

    function removeQuestion(element) {
    let disciplinaId = element.closest(".question-block").dataset.disciplina;
    let questionsContainer = document.getElementById("questionsContainer" + disciplinaId);
    let totalQuestions = questionsContainer.querySelectorAll(".question-block").length;

    if (totalQuestions > 1) {
        element.closest(".question-block").remove();
    } else {
        document.getElementById('alerta').innerHTML="Cada disciplina deve ter pelo menos uma pergunta."
        document.getElementById('myModal').style.display = 'flex';
    }
}

function removeOption(element) {
    let questionBlock = element.closest(".question-block");
    let totalOptions = questionBlock.querySelectorAll(".option-block").length;

    if (totalOptions > 2) {
        element.closest(".option-block").remove();
    } else {
        document.getElementById('alerta').innerHTML="Cada pergunta deve ter pelo menos duas opções.";
        document.getElementById('myModal').style.display = 'flex';
  
    }
}


    function addOption(questionBlock) {
        let optionId = Date.now();
        let optionHTML = `
            <div class="option-block">
                <input type="radio" class="correct-option" name="correct${questionBlock.dataset.disciplina}-${questionBlock.dataset.questao}">
                <div contenteditable="true" class="editable option-text">Nova Opção</div>
                <span class="delete-btn" onclick="removeOption(this)"style="color:red;">x</span>
            </div>`;
        questionBlock.querySelector(".options-container").insertAdjacentHTML("beforeend", optionHTML);
    }

    

    function setCorrect(radio) {
        let options = radio.closest(".options-container").querySelectorAll(".correct-option");
        options.forEach(opt => opt.checked = false);
        radio.checked = true;
    }

    function prepareData() {
        let subjects = {};
        document.querySelectorAll(".question-block").forEach(qb => {
            let disciplinaId = qb.dataset.disciplina;
            let questaoId = qb.dataset.questao;
            let questionText = qb.querySelector(".question-text").innerHTML.trim();
            let options = [];
            let correct = null;
            
            qb.querySelectorAll(".option-block").forEach((ob, index) => {
                let optionText = ob.querySelector(".option-text").innerHTML.trim();
                options.push(optionText);
                if (ob.querySelector(".correct-option").checked) {
                    correct = optionText;
                }
            });

            if (!subjects[disciplinaId]) subjects[disciplinaId] = [];
            subjects[disciplinaId].push({ id: questaoId, text: questionText, options, correct });
        });

        document.getElementById("dados").value = JSON.stringify(subjects);
        // Chamada automática para inicializar perguntas ao carregar a página
document.addEventListener("DOMContentLoaded", function() {
    let disciplinasIds = @json($disciplinas->pluck('id')); // Pega os IDs das disciplinas
    initializeSubjects(disciplinasIds);
});

    }
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
