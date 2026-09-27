<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Informações do Perfil') }}
            <!-- Traduzido: Informações do Perfil -->
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Atualize as informações do perfil da sua conta e endereço de e-mail.') }}
            <!-- Traduzido: Atualize as informações do perfil da sua conta e endereço de e-mail. -->
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- Nome -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nome') }}</label>
            <!-- Traduzido: Nome -->
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
       

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <!-- Traduzido: Email -->
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        {{ __('Seu endereço de e-mail não foi verificado.') }}
                        <!-- Traduzido: Seu endereço de e-mail não foi verificado. -->
                        <button form="send-verification" class="btn btn-link p-0">{{ __('Clique aqui para reenviar o e-mail de verificação.') }}</button>
                        <!-- Traduzido: Clique aqui para reenviar o e-mail de verificação. -->
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success">{{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}</p>
                        <!-- Traduzido: Um novo link de verificação foi enviado para o seu endereço de e-mail. -->
                    @endif
                </div>
            @endif
        </div>

        <!-- Botão -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            <!-- Traduzido: Salvar -->
            @if (session('status') === 'profile-updated')
                <span class="text-success">{{ __('Salvo.') }}</span>
                <!-- Traduzido: Salvo -->
            @endif
        </div>
    </form>
</section>
 
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        const form = document.querySelector("form[action='{{ route('profile.update') }}']");
        const nameInput = document.getElementById("name");
 

        form.addEventListener("submit", function (event) {
            let valid = true;

            // Validação do Nome
            if (nameInput.value.trim().length < 4) {
                valid = false;
                alert("O nome deve ter pelo menos 4 caracteres.");
                nameInput.focus();
                return;
            }

            // Validação do BI
            const biValue = biInput.value.trim();
            const biRegex = /^\d{9}[A-Z]{2}\d{3}$/; // 9 números, 2 letras maiúsculas, 3 números

            if (biValue.length !== 14 || !biRegex.test(biValue)) {
                valid = false;
                alert(
                    "O BI deve ter 14 caracteres, onde os caracteres nas posições 10 e 11 são letras maiúsculas e os outros são números."
                );
                biInput.focus();
                return;
            }

            // Validação do Endereço
            if (enderecoInput.value.trim().length < 3) {
                valid = false;
                alert("O endereço deve ter pelo menos 3 caracteres.");
                enderecoInput.focus();
                return;
            }

            if (!valid) {
                event.preventDefault(); // Impede o envio do formulário se inválido
            }
        });
    });
</script>
