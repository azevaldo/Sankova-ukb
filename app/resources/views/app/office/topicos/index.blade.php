@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de  Topicos da Disciplina  :   {{$disciplina->disciplina}}</h6>
                            <h6 class="text-white text-capitalize ps-3">{{$consulta}} </h6>
                        </div>
 
                    </div>
                    <div class="container   mt-5">
                        <p class="fs-4 fw-bold ">O número  de  topicos  é <span class="text-primary" id="numUniversidades">{{$nTopicos}}</span>.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
                        <a class="btn   btn-sm cabeca2"    href="{{route('topico.index2',$disciplina->id)}}">Pesquisa Todos</a>
                        <a class="btn   btn-sm cabeca2"    href="{{route('disciplina.index2',$disciplina->curso->id)}}">Voltar Para Disciplinas</a>
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
                    <form action="{{route('pesquisa.nomeTopico')}}">
                        <input type="text" class="form-control" id="nomePesquisa" name="nome" placeholder="Digite o nome" required 
                        minlength="3" maxlength="100" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ ]*$" title="O nome deve começar com uma letra e ter pelo menos 3 caracteres.">     
                     <input type="text" name="disciplina_id" hidden value="{{$disciplina->id}}">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tema</th>
                                       
                                      
                                        <th class="text-secondary opacity-7">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#addCursoModal">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topicos as $topico)
                                        <tr>
                                            <td>
                                                @php
                                                $nomes = explode(' ', trim($topico->tema));
                                                $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                                          
                                          @endphp
                                                <p class="text-xs text-secondary mb-0">{{ $primeiroUltimo }}</p>
                                            </td>
                                            

                                            <td class="align-middle">
                                                <a href="{{route('materialEstudo.index2',$topico->id)}}" title="+ Conteudos">
                                                    <i class="fa fa-list "></i>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal{{ $topico->id }}">
                                                    <i class="fa fa-eye vizualizar" title="Visualizar Tópico"></i>
                                                </a>
                                                
                                                <!-- Modal de visualização -->
                                                <div class="modal fade" id="viewModal{{ $topico->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $topico->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detalhes do Tópico</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <!-- Tema -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tema</label>
                                                                        <input type="text" class="form-control" value="{{ $topico->tema }}" disabled>
                                                                    </div>
                                                  
                                                                    <!-- Descrição -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Descrição</label>
                                                                        <textarea class="form-control" rows="3" disabled>{{ $topico->descricao }}</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $topico->id }}">
                                                    <i class="fa fa-edit text-primary" title="Editar Tópico"></i>
                                                </a>
                                                
                                                <!-- Modal de edição -->
                                                <div class="modal fade" id="editModal{{ $topico->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $topico->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                                                    <h5 class="modal-title">Editar Tópico</h5>
                                                                </div>
                                                                <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('topicos.update', $topico->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <!-- Tema -->
                                                                    <div class="mb-3">
                                                                        <label for="tema{{ $topico->id }}" class="form-label">Tema</label>
                                                                        <input type="text" class="form-control" id="tema{{ $topico->id }}" name="tema" value="{{ $topico->tema }}" required>
                                                                    </div>
                                                
                                                                    <!-- Descrição -->
                                                                    <div class="mb-3">
                                                                        <label for="descricao{{ $topico->id }}" class="form-label">Descrição</label>
                                                                        <textarea class="form-control" id="descricao{{ $topico->id }}" name="descricao" rows="3">{{ $topico->descricao }}</textarea>
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
                                               <!-- Botão para excluir tópico -->
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $topico->id }}">
    <i class="fa fa-trash text-danger" title="Excluir Tópico"></i>
</a>

<!-- Modal de exclusão -->
<div class="modal fade" id="deleteModal{{ $topico->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $topico->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @php
                    $nomes = explode(' ', trim($topico->tema));
                    $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
              
              @endphp
                    <p class="fs-5 text-justify text-wrap">
                        Tem certeza de que deseja excluir o tópico 
                        
                        <strong class="text-danger">{{ $primeiroUltimo }}</strong>?
                    </p>
                    <p class="text-muted text-justify text-wrap">
                        Esta ação <strong>não pode ser desfeita</strong>. Todos os dados relacionados serão removidos do sistema.
                    </p>
                </div>
            </div>
            
            <div class="modal-footer d-flex justify-content-between">

                <form method="POST" action="{{ route('topicos.destroy', $topico->id) }}">
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
                            {{$topicos->links('vendor.pagination.bootstrap-5')}}

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
                            <h5 class="modal-title" id="addCursoModalLabel">Adicionar Topicos</h5>
                        </div>
                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('topicos.store') }}">
                            @csrf
                            <!-- Nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Tema</label>
                                <input type="text" class="form-control" id="nome" name="tema" required>
                            </div>
                            <!-- Descrição -->
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>

                            <!-- Usuário -->
                             <!-- Botão Adicionar -->
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                            <!-- Campo oculto para faculdade_id -->
                            <input type="hidden" name="disciplina_id" value="{{ $disciplina->id }}">
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