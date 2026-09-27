@extends("app.geral.layouts.app",["status"=>"usuario"])

@section('diretiva')

<style>
  .heading-page {
    padding: 50px 0;
    background-color: #226ec0;
  }

  .heading-page h2 {
    font-size: 2.5rem;
  }

  .meeting-single-item {
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .form-control {
    border-radius: 8px;
  }

  .btn-primary {
    background-color:#2e89eb;
    border: none;
    width: 100%;
    padding: 15px;
    font-size: 1.1rem;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .text-center p a {
    color:#226ec0;
  }
</style>

@endsection
@section("content")
<section class="heading-page header-text" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="text-center" style="color: #ffffff; font-weight: bold;">Cadastro</h2>
      </div>
    </div>
  </div>
</section>

<section class="meetings-page" id="meetings">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="meeting-single-item p-4" style="background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px; border-top: 5px solid #1E88E5;">
          <div class="thumb text-center mb-4">
            <h3 class="img-fluid" style="max-width: 150px; border-radius: 50%; background-color: #1E88E5; color:white">Cadastro</h3>
          </div>
          <div class="down-content">
            <h4 class="text-center" style="color: #1E88E5; font-weight: bold;">Crie sua conta</h4>
            <p class="text-center" style="color: #555;">Preencha os campos abaixo para se cadastrar.</p>

            <!-- Formulário de cadastro -->
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <!-- Nome -->
              <div class="form-group mb-4">
                <label for="name" class="text-primary small">Nome *</label>
                <input type="text" class="form-control form-control-lg border-primary" id="name" name="name" value="{{ old('name') }}" placeholder="Digite seu nome" required style="border-radius: 8px;">
                @if ($errors->has('name'))
                    <div class="text-danger mt-1 small">
                        {{ $errors->first('name') }}
                    </div>
                @endif
              </div>

              <!-- Email -->
              <div class="form-group mb-4">
                <label for="email" class="text-primary small">Email *</label>
                <input type="email" class="form-control form-control-lg border-primary" id="email" name="email" value="{{ old('email') }}" placeholder="Digite seu email" required style="border-radius: 8px;">
                @if ($errors->has('email'))
                    <div class="text-danger mt-1 small">
                        {{ $errors->first('email') }}
                    </div>
                @endif
              </div>

              <!-- Senha -->
              <div class="form-group mb-4">
                <label for="password" class="text-primary small">Senha *</label>
                <input type="password" class="form-control form-control-lg border-primary" id="password" name="password" placeholder="Digite sua senha" required style="border-radius: 8px;">
                @if ($errors->has('password'))
                    <div class="text-danger mt-1 small">
                        {{ $errors->first('password') }}
                    </div>
                @endif
              </div>

              <!-- Confirmar Senha -->
              <div class="form-group mb-4">
                <label for="password_confirmation" class="text-primary small">Confirmar Senha *</label>
                <input type="password" class="form-control form-control-lg border-primary" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required style="border-radius: 8px;">
              </div>

              <!-- Botão de cadastro -->
              <div class="form-group text-center">
                <input type="submit" value="Cadastrar" class="btn btn-primary btn-lg font-weight-semi-bold py-2 px-4" style="width: 100%; border-radius: 8px; background-color: #1E88E5; border: none;">
              </div>
            </form>

            <div class="text-center">
              <p style="font-size: 16px; color: #555;">
                Já tem uma conta? <a href="{{ route('login') }}" style="color: #1E88E5; font-weight: bold;">Faça login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    let nameInput = document.getElementById("name");

    nameInput.addEventListener("input", function () {
      let valor = this.value;
      
      // Se o primeiro caractere não for uma letra, remove
      if (!/^[a-zA-Z]/.test(valor)) {
        this.value = valor.replace(/^[^a-zA-Z]+/, "");
      }
    });
  });
</script>

@endsection
