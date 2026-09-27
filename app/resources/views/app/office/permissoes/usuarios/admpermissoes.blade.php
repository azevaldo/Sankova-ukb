@extends("app.office.layouts.templete")
@section('diretiva')
<style>
  .btn-primary {
    padding: 10px 50px;
}

</style>
@endsection
@section("content")
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Atribuir Papel De ADM  Geral</h6>
                </div>
              </div>
              <div class="card-body px-4 pb-2">
                
                <!-- Campo de Pesquisa -->
                <form method="GET" action="{{route('permissoes.adm.usuario.email')}}">
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Pesquisar usuário por e-mail" value="{{ request('email') }}">
                    <button class="btn btn-primary px-4" type="submit">
                        <i class="bi bi-search"></i> Pesquisar
                    </button>
                </div>
                
                
                </form>
                <div class="input-group mb-3">
                  
                </div>
                @if(isset($usuario))
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Papel</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Universidade</th>
                          <th class="text-secondary opacity-7">
                               Ações
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                         
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                               <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">{{$usuario->name}}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0"> {{$usuario->email}}</p>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0"> {{$usuario->getRoleNames()->first()}} </p>
                          </td>
                          <td>
                            @if($usuario->entidade_tipo!=null)
                            @if($usuario->entidade_tipo==\App\Models\Universidade::class)
                            <p class="text-xs text-secondary mb-0">{{$usuario->entidade->nome}}  </p>
                            @elseif($usuario->entidade_tipo==\App\Models\Faculdade::class)
                            <p class="text-xs text-secondary mb-0">{{$usuario->entidade->universidade->nome}}  </p>
                            @elseif($usuario->entidade_tipo==\App\Models\Curso::class)
                            <p class="text-xs text-secondary mb-0">{{$usuario->entidade->faculdade->universidade->nome }}  </p>
                            @endif
                            @else
                            <p class="text-xs text-secondary mb-0">Não Pertence a nenhuma </p>
                          
                            @endif
                          </td>
                          <td class="align-middle">
                              
                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#assignRoleModalDesfazer2{{ $usuario->id }}" title="Tornar Usuario ADM">
                              <i class="fas fa-user-tag"></i>
                          </a>
                              
                          
                                                              <!-- Modal Atribuir Papel -->
                                                              <div class="modal fade" id="assignRoleModalDesfazer2{{ $usuario->id }}" tabindex="-1" aria-labelledby="assignRoleModalLabelDesfazer{{ $usuario->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{route('papelAdm')}}">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tornar Usuario Adm Geral </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                              <div class="container-fluid">
                                                                                <p class="fs-5 text-justify text-wrap">
                                                                                   Uma vez adicionado outro adm geral, o usuario atual é transformado em 
                                                                                    <strong class="text-danger">usuario normal</strong>
                                                                                    Tens a certeza?
                                                                                </p>
                                                                               
                                                                            </div>
                                                                                <div class="mb-3">
                                                                                  <input type="text" name="usuario_id" value="{{$usuario->id}}" hidden>
                                                                               </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-success">Atribuir</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>






<!-- Botão para excluir faculdade -->
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $usuario->id }}">
  <i class="fa fa-trash text-danger" title="Excluir usuario"></i>
</a>

<!-- Modal de exclusão -->
<div class="modal fade" id="deleteModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $usuario->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header   text-white">
              <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <p class="fs-5 text-justify text-wrap">
                      Tem certeza de que deseja excluir ao usuario
                      <strong class="text-danger">{{ $usuario->name }}</strong>?
                  </p>
                 
              </div>
          </div>
    
          <div class="modal-footer d-flex justify-content-between">
             
              <form method="POST" action="{{ route('usuario.destroy', $usuario->id) }}">
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
                     
                      </tbody>
                    </table>
                  </div>

                  @else
                  @if(isset($pesquisa))
                  <div class="alert" style="background-color: brown;color:white;">Usuario Não Encontrado</div>
                  @else
                  <div><p>Pesquise Um Usuario  e torne-o o Adm geral do sistema</p></div>
                  @endif
                  @endif
              </div>
            </div>
          </div>
        </div>
@endsection
