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


    .btn-chave {
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

    .btn-chave:hover {
        background-color: #0056b3;
        color: white;
    }

    .btn-chave:active {
        background-color: #003f7f;
    }
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
            color: #b60a0a;
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
            background-color: #275ccf;
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
            background-color: #0f3f75;
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
    

    <div id="examContainer">
        @foreach($simulado->questoes->groupBy('disciplina_id') as $disciplina_id => $questoes)
        @php
            $disciplina = $simulado->curso->disciplinas->firstWhere('id', $disciplina_id);
        @endphp
    
        @if($disciplina)
            <div class="question-card" id="disciplina{{$disciplina->id}}">
                <div class="question-title"> {{$disciplina->disciplina}}</div>
    
                @foreach($questoes as $index => $questao)
                    <div class="question" id="questao{{$questao->id}}">
                        <p><strong>Pergunta {{$index + 1}}:</strong> {!! $questao->texto !!}</p>
    
                        @foreach($questao->alternativas as $altIndex => $alternativa)
                            <label class="options">
                                <input type="radio" name="questao{{$questao->id}}" value="{{$alternativa->id}}" data-correta="{{$alternativa->correta ? '1' : '0'}}">
                                <span>Opção {{$altIndex + 1}}: {!! $alternativa->texto !!}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
    
    </div>

    <div class="footer mt-4 mb-5">
        <button class="btn btn-primary" id="finishButton">Finalizar Prova</button>
        <a href="{{ route('simulado.gerar', $curso->id) }}" class="btn btn-primary">Gerar Outro Simulado</a>
    </div>

    <div id="resultContainer" style="display: none;">
        <h4>Resultados:</h4>
        <ul id="resultList"></ul>
        <input type="number" id="ncorretas" name="ncorretas" hidden>
        <input type="number" id="nincorretas" name="nincorretas" hidden>
        <a href="{{route('simulado.chave',$simulado->id)}}" class="btn-chave mb-4">Ver A chave Da Prova</a>
         <a href="#" id="guardarPonto" class="btn-chave mb-4">Guardar Pontos</a>
       
    </div>
<!-- O Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="icon">&#x26A0;</div> <!-- Ícone de aviso -->
        <h2>Atenção!</h2>
        <p>Por favor, responda todas as questões antes de finalizar a prova.</p>
        <button class="close-btn" id="closeBtn">Fechar</button>
    </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("finishButton").addEventListener("click", function () {
            let questoes = document.querySelectorAll(".question");
            let resultado = {};
            let totalCorretas = 0;
            let totalErradas = 0;
            let todasRespondidas = true;

            questoes.forEach((questao) => {
                let questaoId = questao.id.replace("questao", "");
                let alternativas = questao.querySelectorAll("input[type='radio']");
                let selecionada = null;
                let correta = false;

                alternativas.forEach((alt) => {
                    if (alt.checked) {
                        selecionada = alt.value;
                        correta = alt.dataset.correta === "1"; // Checa se a alternativa correta
                    }
                });

                if (selecionada === null) {
                    todasRespondidas = false;
                } else {
                    let disciplinaId = questao.closest(".question-card").id.replace("disciplina", "");

                    if (!resultado[disciplinaId]) {
                        resultado[disciplinaId] = { corretas: 0, erradas: 0 };
                    }

                    if (correta) {
                        resultado[disciplinaId].corretas++;
                        totalCorretas++;
                    } else {
                        resultado[disciplinaId].erradas++;
                        totalErradas++;
                    }
                }
            });

            if (!todasRespondidas) {
               // document.getElementById("myModal").style.display = "block";
                document.getElementById('myModal').style.display = 'flex';
                return;
            }

            // Exibir os resultados
            let resultList = document.getElementById("resultList");
            resultList.innerHTML = "";

            Object.keys(resultado).forEach((disciplinaId) => {
                let disciplina = document.querySelector(`#disciplina${disciplinaId} .question-title`).innerText;
                resultList.innerHTML += `<li><strong>${disciplina}:</strong> Corretas: ${resultado[disciplinaId].corretas}, Erradas: ${resultado[disciplinaId].erradas}</li>`;
            });

            resultList.innerHTML += `<li><strong>Total da Prova:</strong> Corretas: ${totalCorretas}, Erradas: ${totalErradas}</li>`;

            document.getElementById("ncorretas").value = totalCorretas;
            document.getElementById("nincorretas").value = totalErradas;

            document.getElementById("resultContainer").style.display = "block";
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
    });
</script>

<script>
    document.getElementById("guardarPonto").addEventListener("click", function(event) {
        event.preventDefault(); // Evita o redirecionamento imediato
        
        let valor1 = document.getElementById("ncorretas").value; // Obtém o valor do input
        let valor2 = document.getElementById("nincorretas").value;
        let valor=valor1+" "+valor2;
        if (valor === "") {
            alert("Por favor, insira um valor antes de continuar.");
            return;
        }

        // Atualiza o link com o valor do input na rota
        let url = "{{ route('simulado.ponto', '__VALOR__') }}".replace('__VALOR__', valor);
        
        // Redireciona para a nova URL com o valor atualizado
        window.location.href = url;
    });
</script>
@endsection