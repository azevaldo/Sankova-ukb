@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de Simulados Cursos de  {{$curso->nome}}</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a class="btn   btn-sm cabeca2"    href="{{route('curso.index2',$curso->faculdade->id)}}">Voltar Para Cursos</a>
                   </div>
                    <div class="container   mt-5">
                        <p class="fs-4 fw-bold ">O número  de  simulados é <span class="text-primary" id="numUniversidades">{{$nSimulados}}</span>.</p>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Codigo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                                         <th class="text-secondary opacity-7">
                                          Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($simulados as $simulado)
                                        <tr>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $simulado->id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $simulado->nome }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $simulado->tipo }} </p>
                                            </td>
                                             
                                            <td class="align-middle">
                                                <a href="{{route('simulado.detalhar',$simulado->id)}}" title="Ver Simulado">
                                                    <i class="fa fa-eye vizualizar"></i>
                                                </a>

                                                <a href="{{route('simulado.edit',$simulado->id)}}" title="Editar Simulado">
                                                    <i class="fa fa-edit text-primary"></i>
                                                </a>
                                                <a href="{{route('simulado.destroy',$simulado->id)}}" title="eliminar Simulado"  data-bs-toggle="modal" data-bs-target="#deleteModal{{ $simulado->id }}">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
 
                                                <!-- Botão para excluir universidade -->
 
  <div class="modal fade" id="deleteModal{{ $simulado->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $simulado->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header   text-white">
              <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
            <div class="modal-body">
              <div class="container-fluid">
                  <p class="fs-5 text-justify text-wrap">
                      Tem certeza de que deseja excluir o simulado
                      <strong class="text-danger">{{ $simulado->id }}</strong>?
                  </p>
                  
              </div>
          </div>
          
            <div class="modal-footer d-flex justify-content-between">

                <form method="POST" action="{{ route('simulado.destroy', $simulado->id) }}">
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
                            {{$simulados->links('vendor.pagination.bootstrap-5')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection