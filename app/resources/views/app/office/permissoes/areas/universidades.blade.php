@extends("app.office.layouts.templete")


@section("content")
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Lista De Universidades Para Permissões</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Endereço</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Provincia</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Municipio</th>
                        <th class="text-secondary opacity-7">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($universidades as $uni)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                             <div class="d-flex flex-column justify-content-center">
                            
                              @php
                              $nomes = explode(' ', trim($uni->nome));
                              $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                          @endphp
                          
                          <p class="text-xs text-secondary mb-0">{{ $primeiroUltimo }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                      
                          <p class="text-xs text-secondary mb-0"> {{$uni->endereco}}</p>
                        </td>
                        
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"> {{$uni->municipio->provincia->provincia}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"> {{$uni->municipio->municipio}}</span>
                          </td>
                        <td class="align-middle">
                            <a href="{{ route('permissoes.universidade.usuarios', $uni->id) }}">
                                <i class="fa fa-eye vizualizar" title="Ver Usuarios"></i>
                            </a>
                            <a href="{{ route('permissoes.universidade.faculdades', $uni->id) }}">
                              <i class="fa fa-list "></i>
                              
                            </a>
                            
                        </td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$universidades->links('vendor.pagination.bootstrap-5')}}
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection