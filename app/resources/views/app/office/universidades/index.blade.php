@extends("app.office.layouts.templete")


@section("content")
    <!-- End Navbar -->
    <div class="container-fluid py-2">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" >
                <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3" >
                  <h6 class="text-white text-capitalize ps-3" >Lista De Universidades </h6>
                  <h6 class="text-white text-capitalize ps-3">{{$consulta}} </h6>
                </div>
              </div>
              <div class="container   mt-5">
                <p class="fs-4 fw-bold ">O número  de universidades  é <span class="text-primary" id="numUniversidades">{{$nUniversidades}}</span>.</p>
            
            </div>
            <div class="d-flex justify-content-center gap-2">
                <button class="btn  btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalProvincia">Pesquisa por Província</button>
                <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalMunicipio">Pesquisa por Município</button>
                <button class="btn   btn-sm cabeca2"  data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
                <a class="btn   btn-sm cabeca2"    href="{{route('universidades.index')}}">Pesquisa Todas</a>
            </div>
            <div class="container">
                 <!-- Modal Pesquisa por Província -->
    <div class="modal fade" id="modalProvincia" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesquisa por Província</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pesquisa.provinciaUni')}}">
                        <select class="form-select" id="provincia2" name="provincia_id2" required>
                            <option selected disabled>Selecione a Província</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
                    </form>
                    
                </div>
               
            </div>
        </div>
    </div>

    <!-- Modal Pesquisa por Município -->
    <div class="modal fade" id="modalMunicipio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesquisa por Município</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                 <form action="{{route('pesquisa.municipioUni')}}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="provincia" class="form-label">Província</label>
                            <select class="form-select" id="provincia3" name="provincia_id" required>
                                <option selected disabled>Selecione a Província</option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="municipio" class="form-label">Município</label>
                            <select class="form-select" id="municipio3" name="municipio_id" required>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
                 </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesquisa por Nome -->
    <div class="modal fade" id="modalNome" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesquisa por Nome</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pesquisa.nomeUni')}}" onsubmit="return validarNome()">
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sigla</th>
                      
                       
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Provincia</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Municipio</th>
                       
                        <th class="text-secondary opacity-7"><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">     <i class="fa fa-plus  adicionar" title="Adicionar Universidade"></i></a></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($universidades as $universidade)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                             <div class="d-flex flex-column justify-content-center">
                            
                                @php
                                $nomes = explode(' ', trim($universidade->nome));
                                $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
                            @endphp
                            
                            <p class="text-xs text-secondary mb-0">{{ $primeiroUltimo }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                      
                          <p class="text-xs text-secondary mb-0"> {{$universidade->sigla}}</p>
                        </td>
                     
                        
                        <td>
                      
                          <p class="text-xs text-secondary mb-0"> {{$universidade->email}}</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"> {{$universidade->municipio->provincia->provincia}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"> {{$universidade->municipio->municipio}}</span>
                        </td>
                        
                        <td class="align-middle">
                            <a href="{{route("faculdade.index2",$universidade->id)}}" >
                                <i class="fa fa-list o+spacity-5" title="Ver Faculdades"></i>
                            
                            </a>
<!-- Botão para visualizar universidade -->
<a href="#" data-bs-toggle="modal" data-bs-target="#viewModal{{ $universidade->id }}">
  <i class="fa fa-eye vizualizar" title="Visualizar Universidade"></i>
</a>

<!-- Modal de visualização -->
<div class="modal fade" id="viewModal{{ $universidade->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $universidade->id }}" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Detalhes da Universidade</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
              <form>
                  <!-- Nome -->
                  <div class="mb-3">
                      <label class="form-label">Nome</label>
                      <input type="text" class="form-control" value="{{ $universidade->nome }}" disabled>
                  </div>

                  <!-- Sigla e Endereço -->
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label class="form-label">Sigla</label>
                          <input type="text" class="form-control" value="{{ $universidade->sigla }}" disabled>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label">Endereço</label>
                          <input type="text" class="form-control" value="{{ $universidade->endereco }}" disabled>
                      </div>
                  </div>

                  <!-- Email e Site -->
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" value="{{ $universidade->email }}" disabled>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label">Site</label>
                          <input type="url" class="form-control" value="{{ $universidade->site }}" disabled>
                      </div>
                  </div>

                  <!-- Descrição -->
                  <div class="mb-3">
                      <label class="form-label">Descrição</label>
                      <textarea class="form-control" rows="3" disabled>{{ $universidade->descricao }}</textarea>
                  </div>

                  <!-- Província e Município -->
                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label class="form-label">Província</label>
                          <input type="text" class="form-control" value="{{ $universidade->municipio->provincia->provincia }}" disabled>
                      </div>
                      <div class="col-md-6">
                          <label class="form-label">Município</label>
                          <input type="text" class="form-control" value="{{ $universidade->municipio->municipio }}" disabled>
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
          </div>
      </div>
  </div>
</div>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $universidade->id }}">
                              <i class="fa fa-edit text-primary" title="Editar Universidade"></i>
                          </a>
                      
                          <div class="modal fade" id="editModal{{ $universidade->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $universidade->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                            <h5 class="modal-title">Editar Universidade</h5>
                                        </div>
                                        <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('universidades.update', $universidade->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <!-- Nome -->
                                            <div class="mb-3">
                                                <label for="nome{{ $universidade->id }}" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome{{ $universidade->id }}" name="nome" value="{{ $universidade->nome }}" required>
                                            </div>
                                            <!-- Sigla e Endereço -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="sigla{{ $universidade->id }}" class="form-label">Sigla</label>
                                                    <input type="text" class="form-control" id="sigla{{ $universidade->id }}" name="sigla" value="{{ $universidade->sigla }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="endereco{{ $universidade->id }}" class="form-label">Endereço</label>
                                                    <input type="text" class="form-control" id="endereco{{ $universidade->id }}" name="endereco" value="{{ $universidade->endereco }}" required>
                                                </div>
                                            </div>
                                            <!-- Email e Site -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="email{{ $universidade->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email{{ $universidade->id }}" name="email" value="{{ $universidade->email }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="site{{ $universidade->id }}" class="form-label">Link para o Site</label>
                                                    <input type="url" class="form-control" id="site{{ $universidade->id }}" name="site" value="{{ $universidade->site }}">
                                                </div>
                                            </div>
                                            <!-- Descrição -->
                                            <div class="mb-3">
                                                <label for="descricao{{ $universidade->id }}" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="descricao{{ $universidade->id }}" name="descricao" rows="3">{{ $universidade->descricao }}</textarea>
                                            </div>
                                            <!-- Província e Município -->
                                            <div class="row mb-3">
                                              <div class="col-md-6">
                                                <label for="provincia{{ $universidade->id }}" class="form-label">Província</label>
                                                <select class="form-select provincia" id="provincia{{ $universidade->id }}" name="provincia_id" required data-municipio="municipio{{ $universidade->id }}">
                                                    <option disabled>Selecione a Província</option>
                                                    @foreach ($provincias as $provincia)
                                                        <option value="{{ $provincia->id }}" {{ $universidade->municipio->provincia_id == $provincia->id ? 'selected' : '' }}>{{ $provincia->provincia }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="col-md-6">
                                                  <label for="municipio{{ $universidade->id }}" class="form-label">Município</label>
                                                  <select class="form-select" id="municipio{{ $universidade->id }}" name="municipio_id" required>
                                                      <option disabled>Selecione o Município</option>
                                                      @foreach ($municipios->where('provincia_id', $universidade->municipio->provincia_id) as $municipio)
                                                          <option value="{{ $municipio->id }}" {{ $universidade->municipio_id == $municipio->id ? 'selected' : '' }}>
                                                              {{ $municipio->municipio }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </div>
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
                        @hasanyrole("admin")
 <!-- Botão para excluir universidade -->
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $universidade->id }}">
  <i class="fa fa-trash text-danger" title="Excluir Universidade"></i>
</a>
@endhasanyrole
<div class="modal fade" id="deleteModal{{ $universidade->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $universidade->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header   text-white">
            <h5 class="modal-title" style="color: rgb(134, 78, 78);">Confirmar Exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
          <div class="modal-body">
            <div class="container-fluid">
                @php
                $nomes = explode(' ', trim($universidade->nome));
                $primeiroUltimo = count($nomes) > 1 ? $nomes[0] . ' ' . end($nomes) : $nomes[0];
            @endphp
                <p class="fs-5 text-justify text-wrap">
                    Tem certeza de que deseja excluir a universidade 
                    <strong class="text-danger">{{ $primeiroUltimo }}</strong>?
                </p>
                <p class="text-muted text-justify text-wrap">
                    Esta ação <strong>não pode ser desfeita</strong>. Todos os dados relacionados serão removidos do sistema.
                </p>
            </div>
        </div>
        
        <div class="modal-footer d-flex justify-content-between w-100">

            
            <form method="POST" action="{{ route('universidades.destroy', $universidade->id) }}" class="m-0">
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
                  {{$universidades->links('vendor.pagination.bootstrap-5')}}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <div class="d-flex justify-content-center align-items-center flex-grow-1">
                          <h5 class="modal-title">Adicionar Universidade</h5>
                      </div>
                      <button type="button" class="btn-close fechar" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form method="post" action="{{ route('universidades.store') }}" id="formulario">
                          @csrf
                          <!-- Nome -->
                          <div class="mb-3">
                              <label for="nome" class="form-label">Nome</label>
                              <input type="text" class="form-control" id="nome" name="nome" required>
                          </div>
                          <!-- Sigla e Endereço na mesma linha -->
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="sigla" class="form-label">Sigla</label>
                                  <input type="text" class="form-control" id="sigla" name="sigla" required>
                              </div>
                              <div class="col-md-6">
                                  <label for="endereco" class="form-label">Endereço</label>
                                  <input type="text" class="form-control" id="endereco" name="endereco" required>
                              </div>
                          </div>
                          <!-- Email e Link para o site na mesma linha -->
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                              <div class="col-md-6">
                                  <label for="site" class="form-label">Link para o Site</label>
                                  <input type="text" class="form-control" id="site" name="site">
                              </div>
                          </div>
                          <!-- Descrição -->
                          <div class="mb-3">
                              <label for="descricao" class="form-label">Descrição</label>
                              <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                          </div>
                          <!-- Província e Município na mesma linha -->
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="provincia" class="form-label">Província</label>
                                  <select class="form-select" id="provincia" name="provincia_id" required>
                                      <option selected disabled>Selecione a Província</option>
                                      @foreach ($provincias as $provincia)
                                          <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-md-6">
                                  <label for="municipio" class="form-label">Município</label>
                                  <select class="form-select" id="municipio" name="municipio_id" required>
                                  </select>
                              </div>
                          </div>
                          <!-- Botão Adicionar -->
                          <button type="submit" class="btn btn-primary">Adicionar</button>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                  </div>
              </div>
          </div>
      </div>
            
<script>
   

    
    document.getElementById('provincia').addEventListener('change', function() {
const provinciaId = this.value;
console.log("ola");

fetch(`/getmunicipios/${provinciaId}`)
    .then(response => response.json())
    .then(data => {
        let municipioSelect = document.getElementById('municipio');
        municipioSelect.innerHTML = '<option selected>Seleciona o município</option>';
        data.forEach(municipio => {
            let option = document.createElement('option');
            option.value = municipio.id;
            option.text = municipio.municipio;
            municipioSelect.appendChild(option);
        });
    });
});
 
</script>
<script>
   

    
    document.getElementById('provincia3').addEventListener('change', function() {
const provinciaId3 = this.value;
 

fetch(`/getmunicipios/${provinciaId3}`)
    .then(response => response.json())
    .then(data => {
        let municipioSelect = document.getElementById('municipio3');
        municipioSelect.innerHTML = '<option selected>Seleciona o município</option>';
        data.forEach(municipio => {
            let option = document.createElement('option');
            option.value = municipio.id;
            option.text = municipio.municipio;
            municipioSelect.appendChild(option);
        });
    });
});
 
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".provincia").forEach(function (select) {
          select.addEventListener("change", function () {
              let provincia_id = this.value;
              let municipioSelect = document.getElementById(this.dataset.municipio);
        

              // Limpa os municípios anteriores
              municipioSelect.innerHTML = '<option disabled selected>Carregando...</option>';

              // Faz requisição AJAX para buscar os municípios da província selecionada
              fetch(`/getmunicipios/${provincia_id}`)
                  .then(response => response.json())
                  .then(data => {
                      municipioSelect.innerHTML = '<option disabled selected>Selecione o Município</option>';
                      data.forEach(municipio => {
                          let option = document.createElement("option");
                          option.value = municipio.id;
                          option.textContent = municipio.municipio;
                          municipioSelect.appendChild(option);
                      });
                  })
                  .catch(error => console.error("Erro ao buscar municípios:", error));
          });
      });
  });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nomeInput = document.getElementById("nome");
        const siglaInput = document.getElementById("sigla");

        // Validação do Nome: Deve ter pelo menos 3 caracteres e os 3 primeiros devem ser letras
        nomeInput.addEventListener("input", function () {
            let valor = nomeInput.value;

            // Impede que os 3 primeiros caracteres não sejam letras
            if (valor.length < 3 && /[^A-Za-z]/.test(valor)) {
                nomeInput.value = valor.replace(/[^A-Za-z]/g, "");
            }
        });

        // Validação da Sigla: Apenas letras e pontos, sem espaços, entre 2 e 10 caracteres
        siglaInput.addEventListener("input", function () {
            let valor = siglaInput.value;

            // Permitir apenas letras e pontos
            valor = valor.replace(/[^A-Za-z.]/g, "");

            // Impede espaços
            valor = valor.replace(/\s/g, "");

            // Impede que o primeiro caractere não seja uma letra
            if (valor.length > 0 && !/^[A-Za-z]/.test(valor)) {
                valor = valor.substring(1);
            }

            // Limitar entre 2 e 10 caracteres
            if (valor.length > 14) {
                valor = valor.substring(0, 14);
            }

            siglaInput.value = valor;
        });

        // Validação ao tentar enviar o formulário
        document.querySelector("formulario").addEventListener("submit", function (event) {
            let siglaValor = siglaInput.value.trim();

            if (siglaValor.length < 2 || siglaValor.length > 14) {
                alert("A sigla deve ter entre 2 e 10 caracteres.2");
                event.preventDefault(); // Impede o envio do formulário
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("form").forEach(function (form) {
            let id = form.getAttribute("action").split("/").pop(); // Pega o ID da universidade na URL

            const nomeInput = document.getElementById("nome" + id);
            const siglaInput = document.getElementById("sigla" + id);

            if (nomeInput && siglaInput) {
                // Validação do Nome: Deve ter pelo menos 3 caracteres e os 3 primeiros devem ser letras
                nomeInput.addEventListener("input", function () {
                    let valor = nomeInput.value;

                    // Impede que os 3 primeiros caracteres não sejam letras
                    if (valor.length < 3 && /[^A-Za-z]/.test(valor)) {
                        nomeInput.value = valor.replace(/[^A-Za-z]/g, "");
                    }
                });

                // Validação da Sigla: Apenas letras e pontos, sem espaços, entre 2 e 10 caracteres
                siglaInput.addEventListener("input", function () {
                    let valor = siglaInput.value;

                    // Permitir apenas letras e pontos
                    valor = valor.replace(/[^A-Za-z.]/g, "");

                    // Impede espaços
                    valor = valor.replace(/\s/g, "");

                    // Impede que o primeiro caractere não seja uma letra
                    if (valor.length > 0 && !/^[A-Za-z]/.test(valor)) {
                        valor = valor.substring(1);
                    }

                    // Limitar entre 2 e 10 caracteres
                    if (valor.length > 10) {
                        valor = valor.substring(0, 10);
                    }

                    siglaInput.value = valor;
                });

                // Validação ao tentar enviar o formulário
                form.addEventListener("submit", function (event) {
                    let siglaValor = siglaInput.value.trim();

                    if (siglaValor.length < 2 || siglaValor.length > 10) {
                        alert("A sigla deve ter entre 2 e 10 caracteres.");
                        event.preventDefault(); // Impede o envio do formulário
                    }
                });
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