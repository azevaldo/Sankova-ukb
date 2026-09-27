<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Atualizar Senha') }}
            <!-- Traduzido: Atualizar Senha -->
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Garanta que sua conta está usando uma senha longa e aleatória para se manter segura.') }}
            <!-- Traduzido: Garanta que sua conta está usando uma senha longa e aleatória para se manter segura. -->
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <!-- Senha Atual -->
        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Senha Atual') }}</label>
            <!-- Traduzido: Senha Atual -->
            <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password" required>
            @error('current_password', 'updatePassword')
            <div class="text-danger">{{ $message }}</div>
        @enderror
                </div>

        <!-- Nova Senha -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Nova Senha') }}</label>
            <!-- Traduzido: Nova Senha -->
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
            @error('password', 'updatePassword')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <!-- Confirmação de Senha -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirmar Senha') }}</label>
            <!-- Traduzido: Confirmar Senha -->
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
            @error('password_confirmation', 'updatePassword')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <!-- Botão -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            <!-- Traduzido: Salvar -->
            @if (session('status') === 'password-updated')
                <span class="text-success">{{ __('Salvo.') }}</span>
                <!-- Traduzido: Salvo. -->
            @endif
        </div>
    </form>
</section>
