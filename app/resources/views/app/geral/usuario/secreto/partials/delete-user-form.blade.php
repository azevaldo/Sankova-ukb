<section class="mt-5">
    <header>
        <h2 class="text-lg font-medium text-danger">
            {{ __('Eliminar Conta') }} <!-- Traduzido: Eliminar Conta -->
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Uma vez que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente apagados. Antes de eliminar a sua conta, por favor faça o download de qualquer dado ou informação que deseje manter.') }}
            <!-- Traduzido: Uma vez que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente apagados. Antes de eliminar a sua conta, por favor faça o download de qualquer dado ou informação que deseje manter. -->
        </p>
    </header>

    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">{{ __('Eliminar Conta') }}</button>
    <!-- Traduzido: Eliminar Conta -->

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Confirmar Eliminação de Conta') }}</h5>
                        <!-- Traduzido: Confirmar Eliminação de Conta -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Tem a certeza de que deseja eliminar a sua conta? Uma vez eliminada, todos os dados serão permanentemente removidos. Por favor, insira a sua palavra-passe para confirmar.') }}</p>
                        <!-- Traduzido: Tem a certeza de que deseja eliminar a sua conta? Uma vez eliminada, todos os dados serão permanentemente removidos. Por favor, insira a sua palavra-passe para confirmar. -->

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Palavra-passe') }}</label>
                            <!-- Traduzido: Palavra-passe -->
                            <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Palavra-passe') }}">
                            <!-- Traduzido: Palavra-passe -->
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                        <!-- Traduzido: Cancelar -->
                        <button type="submit" class="btn btn-danger">{{ __('Eliminar Conta') }}</button>
                        <!-- Traduzido: Eliminar Conta -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
