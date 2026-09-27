@extends("app.geral.layouts.app",["status"=>"diversos"])
@section('diretiva')
<style>
      .container2 {
            max-width: 1100px;
            margin-top: 40px;
        }

        .header2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .header2 h1 {
            color: #4A90E2; /* Azul mais claro */
            font-size: 2rem;
            font-weight: 600;
        }

        .header2 p {
            color: #606C76;
            font-size: 1rem;
        }

        .step-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .step-box {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .step-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .step-box i {
            font-size: 35px;
            color: #4A90E2; /* Azul mais claro */
            margin-bottom: 15px;
        }

        .step-box h3 {
            font-size: 1.25rem;
            color: #4A90E2; /* Azul mais claro */
            font-weight: 500;
            margin-bottom: 15px;
        }

        .step-box p {
            color: #606C76;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .step-box button {
            background-color: #4A90E2; /* Azul mais claro */
            color: #fff;
            font-size: 1rem;
            padding: 8px 25px;
            border-radius: 25px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .step-box button:hover {
            background-color: #357ABD;
        }

        .final-step {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 40px;
        }

        .final-step i {
            font-size: 50px;
            color: #4A90E2; /* Azul mais claro */
            margin-bottom: 15px;
        }

        .final-step h3 {
            color: #4A90E2; /* Azul mais claro */
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .final-step p {
            color: #606C76;
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .final-step button {
            background-color: #4A90E2; /* Azul mais claro */
            color: white;
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 25px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .final-step button:hover {
            background-color: #357ABD;
        }

        @media (max-width: 992px) {
            .step-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .step-container {
                grid-template-columns: 1fr;
            }
        }
</style>
@endsection
@section('content')
<div class="container container2">
  <!-- Cabeçalho -->
  <div class="header2">
      <h1>Como Realizar o Teste Simulado</h1>
      <p>Um guia passo a passo para acessar seu simulado e testar seus conhecimentos!</p>
  </div>

  <!-- Passos -->
  <div class="step-container">
      <!-- Passo 1 -->
      <div class="step-box">
          <i class="fas fa-user-check"></i>
          <h3>1. Cadastro e Login</h3>
          <p>Você precisa ter uma conta. Faça login ou crie sua conta aqui.</p>
      </div>

      <!-- Passo 2 -->
      <div class="step-box">
          <i class="fas fa-university"></i>
          <h3>2. Selecione a Universidade</h3>
          <p>Escolha a universidade na qual você está matriculado.</p>
      </div>

      <!-- Passo 3 -->
      <div class="step-box">
          <i class="fas fa-school"></i>
          <h3>3. Escolha a Faculdade</h3>
          <p>Selecione a faculdade que você está cursando.</p>
      </div>

      <!-- Passo 4 -->
      <div class="step-box">
          <i class="fas fa-book"></i>
          <h3>4. Selecione o Curso</h3>
          <p>Escolha o curso para o qual você deseja realizar o simulado.</p>
      </div>

      <!-- Passo 5 -->
      <div class="step-box">
          <i class="fas fa-check-circle"></i>
          <h3>5. Gerar Simulado</h3>
          <p>Clique no botão para gerar o teste simulado aleatório.</p>
      </div>
  </div>

  <!-- Passo Final -->
  <div class="final-step mb-4">
      <i class="fas fa-trophy"></i>
      <h3>Você está pronto para realizar o simulado!</h3>
      <p>Após seguir todos os passos, clique no botão abaixo para começar seu simulado e testar seus conhecimentos!</p>
      <a href="{{route('universidades.all')}}" class="btn btn-primary">Começar Simulado</a>
  </div>
</div>
@endsection