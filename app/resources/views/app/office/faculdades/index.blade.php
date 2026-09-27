@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista De Faculdades Da {{$universidade->nome}}</h6>
                            <h6 class="text-white text-capitalize ps-3">{{$consulta}} </h6>
                        </div>
                    </div>
                    <div class="container   mt-5">
                        <p class="fs-4 fw-bold ">O número  de Faculdades  é <span class="text-primary" id="numUniversidades">{{$nFaculdades}}</span>.</p>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
                        <a class="btn   btn-sm cabeca2"    href="{{route("faculdade.index2",$universidade->id)}}">Pesquisa Todas</a>
                        @hasanyrole('admin|admin_universidade')
                        <a class="btn   btn-sm cabeca2"    href="{{route('universidades.index')}}">Voltar Para Universidades</a>
                        @endhasanyrole
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
                    <form action="{{route('pesquisa.nomeFau')}}">
                        <input type="text" class="form-control" id="nomePesquisa" name="nome" placeholder="Digite o nome" required 
                        minlength="3" maxlength="100" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ ]*$" title="O nome deve começar com uma letra e ter pelo menos 3 caracteres.">   
                        <input type="text" name="uni_id" hidden value="{{$universidade->id}}">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                        
                                         <th class="text-secondary opacity-7">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#addFaculdadeModal">
                                                <i class="fa fa-plus adicionar"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faculdades as $faculdade)
                                        <tr>
                                            <td>
                                                @php
                                                $nomes = explode(' ', trim($faculdade->nome));
                                                $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                                          
                                          @endphp
                                                <p class="text-xs text-secondary mb-0">{{ $primeiroUltimo }}</p>
                                            </td>
                                             
                                            
                                            <td class="align-middle">
                                                <a href="{{route('curso.index2',$faculdade->id)}}" title="Ver Cursos">
                                                    <i class="fa fa-list "></i>
                                                </a>
                                                















 





<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal{{ $faculdade->id }}">
    <i class="fa fa-eye vizualizar" title="Visualizar Faculdade"></i>
  </a>
  
  <!-- Modal de visualização -->
  <div class="modal fade" id="viewModal{{ $faculdade->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $faculdade->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhes da Faculdade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Nome -->
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="url" class="form-control" value="{{ $faculdade->nome }}" disabled>
                    </div>
   
  
                  
  
                    <!-- Descrição -->
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" rows="3" disabled>{{ $faculdade->descricao }}</textarea>
                    </div>
  
                    <!-- Província e Município -->
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
  </div>
  




                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $faculdade->id }}">
                                                    <i class="fa fa-edit text-primary" title="Editar Faculdade"></i>
                                                </a>
                                            
                                                <div class="modal fade" id="editModal{{ $faculdade->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $faculdade->id }}" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                                                  <h5 class="modal-title">Editar Faculdade</h5>
                                                              </div>
                                                              <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <form method="post" action="{{ route('faculdades.update', $faculdade->id) }}">
                                                                  @csrf
                                                                  @method('PUT')
                                                                  <!-- Nome -->
                                                                  <div class="mb-3">
                                                                      <label for="nome{{ $faculdade->id }}" class="form-label">Nome</label>
                                                                      <input type="text" class="form-control" id="nome{{ $faculdade->id }}" name="nome" value="{{ $faculdade->nome }}" required>
                                                                  </div>
                                                                  <!-- Sigla e Endereço -->
                                                                
                                                                
                                                                  <!-- Descrição -->
                                                                  <div class="mb-3">
                                                                      <label for="descricao{{ $faculdade->id }}" class="form-label">Descrição</label>
                                                                      <textarea class="form-control" id="descricao{{ $faculdade->id }}" name="descricao" rows="3">{{$faculdade->descricao }}</textarea>
                                                                  </div>
                                                                  <!-- Província e Município -->
                                                                  
                                                                      
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
                       










 @hasanyrole("admin|admin_universidade")
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $faculdade->id }}">
    <i class="fa fa-trash text-danger" title="Excluir Faculdade"></i>
</a>
@endhasanyrole
<!-- Modal de exclusão -->
<div class="modal fade" id="deleteModal{{ $faculdade->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $faculdade->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header   text-white">
                <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @php
                    $nomes = explode(' ', trim($faculdade->nome));
                    $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                @endphp
                    <p class="fs-5 text-justify text-wrap">
                        Tem certeza de que deseja excluir a faculdade 
                        <strong class="text-danger">{{$primeiroUltimo}}</strong>?
                    </p>
                    <p class="text-muted text-justify text-wrap">
                        Esta ação <strong>não pode ser desfeita</strong>. Todos os dados relacionados serão removidos do sistema.
                    </p>
                </div>
            </div>
            
            <div class="modal-footer d-flex justify-content-between">

                <form method="POST" action="{{ route('faculdades.destroy', $faculdade->id) }}">
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
                            {{$faculdades->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para adicionar faculdades -->
        <div class="modal fade" id="addFaculdadeModal" tabindex="-1" aria-labelledby="addFaculdadeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex justify-content-center align-items-center flex-grow-1">
                            <h5 class="modal-title" id="addFaculdadeModalLabel">Adicionar Faculdade</h5>
                        </div>
                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('faculdades.store') }}">
                            @csrf
                            <!-- Nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <!-- Descrição -->
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>
                           
                            <!-- Botão Adicionar -->
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                            <!-- Campo oculto para universidade_id -->
                            <input type="hidden" name="universidade_id" value="{{ $universidade->id }}">
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
