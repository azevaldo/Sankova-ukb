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
    background-color: #007bff;
    border: none;
    width: 100%;
    padding: 15px;
    font-size: 1.1rem;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .text-center p a {
    color: #226ec0;
  }
</style>

@endsection
@section("content") 


<section class="heading-page header-text" id="top" style="background-color: #226ec0;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="text-center" style="color: #ffffff; font-weight: bold;">Entrar</h2>
      </div>
    </div>
  </div>
</section>

<!-- Seção de Login -->
<section class="meetings-page" id="meetings" style="background-color: #f8f9fa; padding-top: 40px; padding-bottom: 40px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="meeting-single-item p-5" style="background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px;">
          <div class="thumb text-center mb-4">
            <h3 class="img-fluid" style="max-width: 150px; border-radius: 50%; background-color: #226ec0; color:white; padding: 20px;">Entrar</h3>
          </div>
          <div class="down-content">
            <h4 class="text-center" style="color: #226ec0; font-weight: bold;">Acesse sua conta</h4>
            <p class="text-center" style="color: #555;">Insira suas credenciais para continuar.</p>

            <!-- Formulário de login -->
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email -->
              <div class="form-group mb-4">
                <label for="email" class="text-primary small">Email *</label>
                <input type="email" class="form-control form-control-lg border-primary" id="email" name="email" placeholder="Digite seu email" value="{{ old('email') }}" required autofocus style="border-radius: 8px;">
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

              <!-- Lembrar-me -->
              <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                    <label class="form-check-label text-primary small" for="remember_me">
                        Lembrar-me
                    </label>
                </div>
              </div>

              <!-- Esqueceu a senha -->
              <div class="form-group mb-4 text-center">
                @if (Route::has('password.request'))
                    <a class="text-primary small" href="">
                        Esqueceu sua senha?
                    </a>
                @endif
              </div>

              <!-- Botão de login -->
              <div class="form-group text-center">
                <input type="submit" value="Entrar" class="btn btn-primary btn-lg font-weight-semi-bold py-2 px-4" style="width: 100%; border-radius: 8px; background-color: #007bff; border: none;">
              </div>
            </form>

            <div class="text-center">
              <p style="font-size: 16px; color: #555;">
                Não tem uma conta? <a href="{{ route('register') }}" style="color: #226ec0; font-weight: bold;">Cadastre-se</a>
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
    let emailInput = document.getElementById("email");

    emailInput.addEventListener("input", function () {
      this.value = this.value.toLowerCase();
    });
  });
</script>
@endsection
