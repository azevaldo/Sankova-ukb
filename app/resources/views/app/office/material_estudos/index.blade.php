@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de  Material de Conteudo do Tema  :   {{$topico->tema}}</h6>
                            <h6 class="text-white text-capitalize ps-3">{{$consulta}} </h6>
                        </div>
 
                    </div>
                    <div class="container   mt-5">
                        <p class="fs-4 fw-bold ">O número  de  Material de conteudo  é <span class="text-primary" id="numUniversidades">{{$nMat}}</span>.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
                        <a class="btn   btn-sm cabeca2"  href="{{route('materialEstudo.index2',$topico->id)}}">Pesquisa Todos</a>
                        <a class="btn   btn-sm cabeca2"   href="{{route('topico.index2',$topico->disciplina->id)}}">Voltar Para Topicos</a>
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
                    <form action="{{route('pesquisa.nomeMaterial')}}">
                        <input type="text" class="form-control" id="nomePesquisa" name="nome" placeholder="Digite o nome" required 
                        minlength="3" maxlength="100" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ ]*$" title="O nome deve começar com uma letra e ter pelo menos 3 caracteres.">
                     <input type="text" name="topico_id" hidden value="{{$topico->id}}">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subtema</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento</th>
                                     
                                      
                                        <th class="text-secondary opacity-7">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#addCursoModal">
                                                <i class="fa fa-plus adicionar"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materiais as $materialEstudo)
                                        <tr>
                                            <td>
                                                @php
                                                $nomes = explode(' ', trim($materialEstudo->subtema));
                                                $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                                          
                                          @endphp
                                                <p class="text-xs text-secondary mb-0">{{ $primeiroUltimo }}</p>
                                            </td>
                                            <td>
 
                                                <p class="text-xs text-secondary mb-0">                                              <a href="/materials/{{$materialEstudo->doc}}" target="_blank">Ver docs </a> </p>
                                            </td>

                                            <td class="align-middle">
                                               

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal{{ $materialEstudo->id }}">
                                                    <i class="fa fa-eye vizualizar" title="Visualizar Material de Estudo"></i>
                                                </a>
                                                
                                                <!-- Modal de visualização -->
                                                <div class="modal fade" id="viewModal{{ $materialEstudo->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $materialEstudo->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detalhes do Material de Estudo</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <!-- Subtema -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Subtema</label>
                                                                        <input type="text" class="form-control" value="{{ $materialEstudo->subtema }}" disabled>
                                                                    </div>
                                                
                                                                    <!-- Documento -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Documento PDF</label>
                                                                        <a href="/materials/{{$materialEstudo->doc}}" class="btn btn-secondary" target="_blank">Abrir PDF</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $materialEstudo->id }}">
                                                    <i class="fa fa-edit text-primary" title="Editar Material de Estudo"></i>
                                                </a>
                                                
                                                <!-- Modal de edição -->
                                                <div class="modal fade" id="editModal{{ $materialEstudo->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $materialEstudo->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                                                    <h5 class="modal-title">Editar Material de Estudo</h5>
                                                                </div>
                                                                <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('materialEstudos.update', $materialEstudo->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <!-- Subtema -->
                                                                    <div class="mb-3">
                                                                        <label for="subtema{{ $materialEstudo->id }}" class="form-label">Subtema</label>
                                                                        <input type="text" class="form-control" id="subtema{{ $materialEstudo->id }}" name="subtema" value="{{ $materialEstudo->subtema }}" required>
                                                                    </div>
                                                
                                                                    <!-- Documento -->
                                                                    <div class="mb-3">
                                                                        <label for="doc{{ $materialEstudo->id }}" class="form-label">Documento PDF</label>
                                                                        <input type="file" class="form-control" id="doc{{ $materialEstudo->id }}" name="doc" accept=".pdf">
                                                                        <small class="form-text text-muted">Deixe em branco para manter o documento atual.</small>
                                                                    </div>
                                                
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
                                                <!-- Botão para excluir material de estudo -->
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $materialEstudo->id }}">
    <i class="fa fa-trash text-danger" title="Excluir Material de Estudo"></i>
</a>

<!-- Modal de exclusão -->
<div class="modal fade" id="deleteModal{{ $materialEstudo->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $materialEstudo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @php
                    $nomes = explode(' ', trim($materialEstudo->subtema));
                    $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
              
              @endphp
                    <p class="fs-5 text-justify text-wrap">
                        Tem certeza de que deseja excluir o material de estudo 
                        <strong class="text-danger">{{ $primeiroUltimo }}</strong>?
                    </p>
                    <p class="text-muted text-justify text-wrap">
                        Esta ação <strong>não pode ser desfeita</strong>. Todos os dados relacionados serão removidos do sistema.
                    </p>
                </div>
            </div>
            
            <div class="modal-footer d-flex justify-content-between">
               
                <form method="POST" action="{{ route('materialEstudos.destroy', $materialEstudo->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$materiais->links('vendor.pagination.bootstrap-5')}}
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
                            <h5 class="modal-title" id="addCursoModalLabel">Adicionar Material de estudo</h5>
                        </div>
                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('materialEstudos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Sub-Tema</label>
                                <input type="text" class="form-control" id="nome" name="subtema" required>
                            </div>
                            <!-- Descrição -->
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Documento</label>
                             <input type="file" class="form-control" id="nome" name="doc" required accept="application/pdf">
                            </div>

                            <!-- Usuário -->
                             <!-- Botão Adicionar -->
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                            <!-- Campo oculto para faculdade_id -->
                            <input type="hidden" name="topico_id" value="{{ $topico->id }}">
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