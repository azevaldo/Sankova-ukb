@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de provincias</h6>
                            <h6 class="text-white text-capitalize ps-3">{{$consulta}} </h6>
                        </div>
                    </div>
                    <div class="container   mt-5">
                        <p class="fs-4 fw-bold ">O número  de provincias  é <span class="text-primary" id="numUniversidades">{{$nprovincias}}</span>.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
                            </div>
                    <div class="container">
                            <!-- Modal Pesquisa por Nome -->
    <div class="modal fade" id="modalNome" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesquisa por Nome</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pesquisa.nomeProvincia')}}">
                        <input type="text" class="form-control" id="nomePesquisa" name="nome" placeholder="Digite o nome" required 
                        minlength="3" maxlength="100" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ ]*$" title="O nome deve começar com uma letra e ter pelo menos 3 caracteres.">   
                 
                    <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Provincia</th>
                                        <th class="text-secondary opacity-7">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#addCursoModal">
                                                <i class="fa fa-plus adicionar"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($provincias as $provincia)
                                        <tr>
                                            <td class="align-middle">
                                                <p class="text-xs text-secondary mb-0">{{ $provincia->provincia }}</p>
                                            </td>
                                           

                                             
                                            <td class="align-middle">
                                               

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $provincia->id }}">
                                                    <i class="fa fa-edit text-primary" title="Editar Provincia"></i>
                                                </a>
                                                
                                                <!-- Modal de edição -->
                                                <div class="modal fade" id="editModal{{ $provincia->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $provincia->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                                                    <h5 class="modal-title">Provincia </h5>
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="{{ route('provincias.update', $provincia->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <!-- Nome -->
                                                                    <div class="mb-3">
                                                                        <label for="nome{{ $provincia->id }}" class="form-label">Provincia</label>
                                                                        <input type="text" class="form-control" id="nome{{ $provincia->id }}" name="provincia" value="{{ $provincia->provincia }}" required>
                                                                    </div>
                                                                    <!-- Descrição -->
                                                                  
                                                                    <!-- Duração -->
                                                                   
                                                                    <!-- Botão de Salvar -->
                                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @hasanyrole("admin")
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $provincia->id }}">
                                                    <i class="fa fa-trash text-danger" title="Excluir Curso"></i>
                                                </a>
                                                @endhasanyrole
                                                <!-- Modal de exclusão -->
                                                <div class="modal fade" id="deleteModal{{ $provincia->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $provincia->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-white"  >
                                                                <h5 class="modal-title" style="color: rgb(121, 65, 65)">Confirmar Exclusão</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                  
                                                                    <p class="fs-5 text-justify text-wrap">
                                                                        Tem certeza de que deseja excluir a provincia
                                                                        <strong class="text-danger">{{ $provincia->provincia }}</strong>?
                                                                    </p>
                                                                    <p class="text-muted text-justify text-wrap">
                                                                        Esta ação <strong>não pode ser desfeita</strong>. Todos os dados relacionados serão removidos do sistema.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-between">
                                                                <form method="POST" action="{{ route('provincias.destroy', $provincia->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                  

                                               
                                                <a href="{{route('municipio.geral',$provincia->id)}}" title="Listar de municipios">
                                                    <i  class="fa fa-list-ol lista"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$provincias->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para adicionar cursos -->
        <div class="modal fade" id="addCursoModal" tabindex="-1" aria-labelledby="addCursoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex justify-content-center align-items-center flex-grow-1">
                            <h5 class="modal-title" id="addCursoModalLabel">Adicionar Provincia</h5>
                        </div>
                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('provincias.store') }}">
                            @csrf
                            <!-- Nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Provincia</label>
                                <input type="text" class="form-control" id="nome" name="provincia" required>
                            </div>
                          
                          
                           
                            <!-- Botão Adicionar -->
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                            <!-- Campo oculto para faculdade_id -->
                           
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nomeInput = document.getElementById("nome");
           
            // Validação do Nome: Deve ter pelo menos 3 caracteres e os 3 primeiros devem ser letras
            nomeInput.addEventListener("input", function () {
                let valor = nomeInput.value;
    
                // Impede que os 3 primeiros caracteres não sejam letras
                if (valor.length < 3 && /[^A-Za-z]/.test(valor)) {
                    nomeInput.value = valor.replace(/[^A-Za-z]/g, "");
                }
            });
    
           
    
        
        });
    </script>
    <script>
        document.getElementById("nomePesquisa").addEventListener("input", function() {
            let valor = this.value;
    
            // Impede espaços no início
            if (valor.length > 0 && valor[0] === " ") {
                this.value = valor.trim();
            }
    
            // Garante que o primeiro caractere seja uma letra
            if (!/^[A-Za-zÀ-ÖØ-öø-ÿ]/.test(valor)) {
                this.value = "";
            }
        });
    
        function validarNome() {
            let nomeInput = document.getElementById("nomePesquisa");
            let nomeValor = nomeInput.value.trim();
    
            // Verifica se o nome começa com uma letra e tem pelo menos 3 caracteres
            if (nomeValor.length < 3 || !/^[A-Za-zÀ-ÖØ-öø-ÿ]/.test(nomeValor)) {
                alert("O nome deve começar com uma letra e ter pelo menos 3 caracteres.");
                nomeInput.focus();
                return false;
            }
            return true;
        }
    </script>
@endsection