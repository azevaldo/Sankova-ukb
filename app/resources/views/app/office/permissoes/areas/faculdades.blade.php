@extends("app.office.layouts.templete")

@section("content")
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista De Faculdades Da {{$universidade->nome}}</h6>
                        </div>
                    </div>
                    @hasanyrole('admin|admin_universidade')
                    <div class="d-flex justify-content-center gap-2 mt-4">
                         <a class="btn   btn-sm cabeca2"    href="{{route('permissoes.universidades')}}">Voltar Para Universidades</a>
                    </div>
                    @endhasanyrole
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                         <th class="text-secondary opacity-7">
                                           Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faculdades as $faculdade)
                                        <tr>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $faculdade->nome }}</p>
                                            </td>
                                           
                                            
                                            <td class="align-middle">
                                                <a href="{{ route('permissoes.faculdade.usuarios', $faculdade->id) }}">
                                                    <i class="fa fa-eye vizualizar"   title="Ver Usuarios"></i>
                                                </a>
                                                <a href="{{route('permissoes.universidade.faculdade.cursos', $faculdade->id)}}" title="Ver Cursos">
                                                    <i class="fa fa-list "></i>
                                                </a>
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

      
    </div>
@endsection
