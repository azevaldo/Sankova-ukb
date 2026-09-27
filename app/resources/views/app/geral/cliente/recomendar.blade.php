@extends("app.geral.layouts.app",["status"=>"diversos"])
@section('diretiva')
<style>
    /* Estilização do Modal */
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
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-4">Obtenha Recomendações de Cursos</h3>
                <form action="{{ route('recomendar.curso') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="gostos" class="form-label">Gostos</label>
                        <input type="text" class="form-control form-control-lg" id="gostos" name="gostos" 
                               value="{{ old('gostos') }}" placeholder="Exemplo: Arte, Tecnologia, Música" required>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="habilidades" class="form-label">Habilidades</label>
                        <input type="text" class="form-control form-control-lg" id="habilidades" name="habilidades" 
                               value="{{ old('habilidades') }}" placeholder="Exemplo: Programação, Desenho, Comunicação" required>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="interesses" class="form-label">Interesses</label>
                        <input type="text" class="form-control form-control-lg" id="interesses" name="interesses" 
                               value="{{ old('interesses') }}" placeholder="Exemplo: Inteligência Artificial, Robótica, Música" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary btn-lg w-100">Obter Recomendações</button>
                </form>
                

                @if(session('resposta'))
                    <div class="alert alert-success mt-4 text-center">
                        <h5>Recomendações de Cursos:</h5>
                        <p style="text-align: justify;text-indent:13px">{{ session('resposta') }}</p>
                    </div>
                @endif
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="icon">&#x26A0;</div> <!-- Ícone de aviso -->
                        <h2>Atenção!</h2>
                        <p id="informacoes"></p>
                        <button class="close-btn" id="closeBtn">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector("form").addEventListener("submit", function (e) {
            let campos = ["gostos", "habilidades", "interesses"];
            let erros = [];
    
            campos.forEach(function (campo) {
                let input = document.getElementById(campo);
                if (!input.value.trim()) {
                    erros.push("O campo <b>" + campo.charAt(0).toUpperCase() + campo.slice(1) + "</b> não pode ser vazio ou conter apenas espaços.");
                }
            });
    
            if (erros.length > 0) {
                e.preventDefault(); // Impede o envio do formulário
                
                // Adiciona as mensagens de erro ao modal
                document.getElementById("informacoes").innerHTML = erros.join("<br>");
    
                // Exibe o modal
                document.getElementById("myModal").style.display = "flex";
            }
        });
    
        // Fechar modal ao clicar no botão de fechar
        document.getElementById("closeBtn").addEventListener("click", function () {
            document.getElementById("myModal").style.display = "none";
        });
    });
    </script>
    
@endsection
