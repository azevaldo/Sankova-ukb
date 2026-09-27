@extends("app.office.layouts.templete")

@section("content")
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Universidade : {{$universidade->nome}}</h6>
                  <h6 class="text-white text-capitalize ps-3">Lista De Gestores da Faculdade : {{$faculdade->nome}}</h6>
                </div>
              </div>
              <div class="card-body px-4 pb-2">
                
                <!-- Campo de Pesquisa -->
                <form method="GET" action="{{route('permissoes.faculdade.usuario.email')}}">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Pesquisar usuário por e-mail" value="{{ request('email') }}">
                        <input type="text" name="faculdade_id" value="{{$faculdade->id}}" hidden>
                        <button class="btn btn-primary" type="submit">Pesquisar</button>
                    </div>
                    <div class="input-group mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Pesquisar usuário por e-mail" value="{{ request('email') }}">
                      <input type="text" name="faculdade_id" value="{{$faculdade->id}}" hidden>
                       <button class="btn btn-primary px-4" type="submit">
                          <i class="bi bi-search"></i> Pesquisar
                      </button>
                  </div>
                </form>
                <div class="input-group mb-3">
                  <a class="btn btn-primary" href="{{ route('permissoes.faculdade.usuarios', $universidade->id) }}" style="margin-right: 7px">Buscar Todos</a>
                  <a class="btn btn-primary" href="{{ route('permissoes.universidade.faculdades', $universidade->id) }}">Voltar</a>
                </div>
                @if(isset($usuarios))







                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Papel</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Faculdade</th>
 
                          <th class="text-secondary opacity-7">
                               Ações
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($usuarios as $usuario)
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
                            @if($usuario->entidade_tipo==\App\Models\Faculdade::class)
                            <p class="text-xs text-secondary mb-0">{{$usuario->entidade->nome}}  </p>
                       @endif
                            @else
                            <p class="text-xs text-secondary mb-0">Não Pertence a nenhuma </p>
                          
                            @endif
                          </td>
                          <td class="align-middle">
                              
                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#assignRoleModalDesfazer2{{ $usuario->id }}" title="Tornar Usuario Normal">
                              <i class="fas fa-user-tag" style="color: red;"></i>
                          </a>
                              
                          
                                                              <!-- Modal Atribuir Papel -->
                                                              <div class="modal fade" id="assignRoleModalDesfazer2{{ $usuario->id }}" tabindex="-1" aria-labelledby="assignRoleModalLabelDesfazer{{ $usuario->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{route('papelFaculdadeDesfazer')}}">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tornar Usuario Normal </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                               
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
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{$usuarios->links('vendor.pagination.bootstrap-5')}}
                  </div>










                @else
     





                <div>
                    <p>Email : {{$requestEmail}}</p>
                </div>


                @if($usuario2==null)
                <div class="alert" style="color: rgb(255, 255, 255);background-color:rgb(143, 57, 57)">
                  Usuario Não Existe
                    </div>
                @else
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Papel</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Faculdade</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Curso</th>
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
                                <p class="text-xs text-secondary mb-0">{{$usuario2->name}}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0"> {{$usuario2->email}}</p>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0"> {{$usuario2->getRoleNames()->first()}} </p>
                          </td>
                          <td>
                            @if($usuario2->entidade_tipo!=null)

                            @if($usuario2->entidade_tipo==\App\Models\Faculdade::class)
                            <p class="text-xs text-secondary mb-0">{{$usuario2->entidade->nome}}  </p>
                             
                              @elseif($usuario2->entidade_tipo==\App\Models\Curso::class)
                              <p class="text-xs text-secondary mb-0">Curso : {{$usuario2->entidade->faculdade->nome}}  </p>
                              @endif
                            @else
                            <p class="text-xs text-secondary mb-0">Não Pertence a nenhuma </p>
                          
                            @endif
                          </td>
                          <td>
                            @if($usuario2->entidade_tipo!=null)

                            @if($usuario2->entidade_tipo==\App\Models\Faculdade::class)
                            <p class="text-xs text-secondary mb-0">Não pertence   </p>
                             
                              @elseif($usuario2->entidade_tipo==\App\Models\Curso::class)
                              <p class="text-xs text-secondary mb-0">Curso : {{$usuario2->entidade->faculdade->nome}}  </p>
                              @endif
                            @else
                            <p class="text-xs text-secondary mb-0">Não Pertence a nenhum </p>
                          
                            @endif
                          </td>
                          <td class="align-middle">
                              @if(!($usuario2->entidade_tipo==\App\Models\Faculdade::class))
                              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#assignRoleModal{{ $usuario2->id }}" title="Atribuir Privilegio Faculdade">
                                <i class="fas fa-user-tag"></i>
                            </a>
                            @endif
                            @if(!(($usuario2->getRoleNames()->first())=='normal'))
                            <a href="#" class="text-primary"  data-bs-toggle="modal" data-bs-target="#assignRoleModalDesfazer{{ $usuario2->id }}" title="Tornar Usuario Normal Privilegio">
                              <i class="fas fa-user-tag" style="color: rgb(241, 35, 35)"></i>
                            </a>
                          @endif
                              


                                                              <!-- Modal Atribuir Papel -->
                                                              <div class="modal fade" id="assignRoleModal{{ $usuario2->id }}" tabindex="-1" aria-labelledby="assignRoleModalLabel{{ $usuario2->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{route('papelFaculdade')}}">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Atribuir Papel Faculdade Admin</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                   <input type="text" name="faculdade_id" value="{{$faculdade->id}}" hidden>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                  <input type="text" name="usuario_id" value="{{$usuario2->id}}" hidden>
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



                                                            

                                                              <!-- Modal Atribuir Papel -->
                                                              <div class="modal fade" id="assignRoleModalDesfazer{{ $usuario2->id }}" tabindex="-1" aria-labelledby="assignRoleModalLabelDesfazer{{ $usuario2->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{route('papelFaculdadeDesfazer')}}">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tornar Usuario Normal </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                               
                                                                                <div class="mb-3">
                                                                                  <input type="text" name="usuario_id" value="{{$usuario2->id}}" hidden>
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
                          </td>
                        </tr>
                
                      </tbody>
                    </table>
                  </div>





                  @endif
                @endif


              </div>
            </div>
          </div>
        </div>
@endsection
