@extends("app.geral.layouts.app",["status"=>"usuario"])

@section('diretiva')
<style>
    .performance-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .card-header {
        background-color: #007bff;
        color: #ffffff;
        border-radius: 12px 12px 0 0;
        padding: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0;
    }

    .user-info {
        margin-bottom: 1.5rem;
    }

    .user-name {
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
    }

    .user-status {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .performance-stats {
        margin: 0 auto;
    }

    .stat-card {
        border: none;
        border-radius: 10px;
        padding: 1.5rem 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        color: #ffffff;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .stat-title {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-subtext {
        font-size: 0.8rem;
        opacity: 0.9;
    }

    .feedback {
        margin-top: 1.5rem;
    }

    .feedback-message {
        font-size: 0.9rem;
        color: #6c757d;
        font-style: italic;
    }

    .card-footer {
        background-color: #ffffff;
        border-top: 1px solid #e9ecef;
        padding: 1rem;
    }

    /* Gradientes Personalizados */
    .bg-success-gradient {
        background: linear-gradient(135deg, #28a745, #218838);
    }

    .bg-danger-gradient {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }

    .bg-info-gradient {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }
</style>
@endsection

@section('content')
<div class="container mt-5 mb-4">
    <div class="card performance-card">
        <div class="card-header text-center">
            <h4 class="card-title mb-0">Desempenho do Usuário</h4>
        </div>
        <div class="card-body">
            <!-- Nome do Usuário -->
            <div class="user-info text-center mb-4">
                <h5 class="user-name">{{ $user->name }}</h5>
                <p class="user-status">Situação: <span id="situacao" style="font-size: 1.5rem;font-weight:bold"></span></p>
            </div>

            <!-- Dados de Desempenho -->
            <div class="row performance-stats">
                <!-- Card de Acertos -->
                <div class="col-md-4 mb-3">
                    <div class="stat-card text-center bg-success-gradient">
                        <i class="fas fa-check-circle stat-icon"></i>
                        <h6 class="stat-title" style="color: white">Acertos</h6>
                        <p class="stat-value" id="acertos">{{ $user->desempenho->corretas }}</p>
                        <small class="stat-subtext">Continue!</small>
                    </div>
                </div>

                <!-- Card de Erros -->
                <div class="col-md-4 mb-3">
                    <div class="stat-card text-center bg-danger-gradient">
                        <i class="fas fa-times-circle stat-icon"></i>
                        <h6 class="stat-title" style="color: white">Erros</h6>
                        <p class="stat-value" id="erros">{{ $user->desempenho->incorretas }}</p>
                        <small class="stat-subtext">Revise os conteúdos.</small>
                    </div>
                </div>

                <!-- Card de Testes -->
                <div class="col-md-4 mb-3">
                    <div class="stat-card text-center bg-info-gradient">
                        <i class="fas fa-clipboard-list stat-icon"></i>
                        <h6 class="stat-title" style="color: white">Testes</h6>
                        <p class="stat-value" id="testes">{{ $user->desempenho->nsimulados }}</p>
                        <small class="stat-subtext">Continue praticando!</small>
                    </div>
                </div>
            </div>

            <!-- Mensagem de Feedback -->
            <div class="feedback text-center mt-4">
                <p class="feedback-message" id="mensagem"></p>
            </div>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">Revisão de desempenho</small>
        </div>
    </div>
</div>

<script>
    // Dados do usuário (substitua por valores reais ou dinâmicos)
    const acertos = {!! json_encode($user->desempenho->corretas) !!};
const erros = {!! json_encode($user->desempenho->incorretas) !!};
const testes = {!! json_encode($user->desempenho->nsimulados) !!};
  // Número de testes realizados

    // Atualiza os valores na tela
    document.getElementById('acertos').textContent = acertos;
    document.getElementById('erros').textContent = erros;
    document.getElementById('testes').textContent = testes;

    // Cálculo do percentual de acertos
    const totalPerguntas = acertos + erros;
    const percentualAcertos = (acertos / totalPerguntas) * 100;

    // Elementos do HTML que serão atualizados
    const situacaoElement = document.getElementById('situacao');
    const mensagemElement = document.getElementById('mensagem');

    // Lógica para definir a situação
    let situacao, cor, mensagem;

    if (percentualAcertos >= 70) {
        situacao = "Boa";
        cor = "success";
        mensagem = "Você está no caminho certo! Continue assim.";
    } else if (percentualAcertos >= 40) {
        situacao = "Razoável";
        cor = "black";
        mensagem = "Você está indo bem, mas pode melhorar.";
    } else {
        situacao = "Ruim";
        cor = "danger";
        mensagem = "Há espaço para melhorias. Revise os conteúdos.";
    }

    // Atualiza a situação e a mensagem
    situacaoElement.textContent = situacao;
    situacaoElement.className = `text-${cor}`; // Aplica a cor correspondente
    mensagemElement.textContent = mensagem;
</script>
@endsection