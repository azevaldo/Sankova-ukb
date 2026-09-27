@extends("app.geral.layouts.app",["status"=>"uni"])
@section('diretiva')

<style>
   
    .bto:hover {
            background-color: white; /* Muda o fundo para branco */
            color: rgb(70, 113, 231); /* Muda o texto para azul */
            border: 1px solid rgb(70, 113, 231); /* Adiciona uma borda azul */
        }
</style>
@endsection
@section("content")
<section id="universidades" class="universidades section">
  <div class="container">
    <!-- Formulário de Filtro -->
    <div class="mb-4">
      <h3>Filtros de consulta</h3>
      
  
      <div style="border: 1px solid rgba(0, 0, 0, 0.158); padding: 10px; width: 100%;">
        <div class="d-flex justify-content-center gap-2 mb-5">
            <button class="btn btn-sm bto" style="background-color: rgb(70, 113, 231); color: white;" data-bs-toggle="modal" data-bs-target="#modalProvincia">Pesquisa por Província</button>
            <button class="btn btn-sm" style="background-color: rgb(70, 113, 231); color: white;" data-bs-toggle="modal" data-bs-target="#modalMunicipio">Pesquisa por Município</button>
            <button class="btn btn-sm" style="background-color: rgb(70, 113, 231); color: white;" data-bs-toggle="modal" data-bs-target="#modalNome">Pesquisa por Nome</button>
            <a class="btn btn-sm" style="background-color: rgb(70, 113, 231); color: white;" href="{{route('universidades.all')}}">Pesquisa Todas</a>
        </div>
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
        <form action="{{route('pesquisa.provinciaUni2')}}">
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
     <form action="{{route('pesquisa.municipioUni2')}}">
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
        <form action="{{route('pesquisa.nomeUni2')}}">
         <input type="text" class="form-control" name="nome" placeholder="Digite o nome">
        <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
        </form>    
    </div>
</div>
</div>
</div>
</div>







    <!-- Lista de Universidades -->
    <div class="row" id="lista-universidades">
      <!-- Exemplo de universidade -->
      <div  id="status" class="mt-5 mb-3">
        <h3 style="text-align: center">Lista de universidades</h3>
 <h5>{{$consulta}}</h5>
    </div>
      @if($universidades->isEmpty())
<div class="alert alert-danger">
    Não há universidades cadastradas.
</div>
            @else

       @foreach($universidades as $universidade)
      <div class="col-md-6 col-lg-3 mt-3" data-provincia="{{$universidade->municipio->provincia->provincia}}" data-municipio="{{$universidade->municipio->municipio}}">
        <a href="{{route('universidade.detalhes',$universidade->id)}}">
          <div class="card university-card text-center p-3 shadow-sm border-0 hover-effect">
            <i class="fas fa-university fa-2x text-primary mb-3"></i>
            <div class="card-body">
              <h5 class="card-title mb-2">{{$universidade->sigla}}</h5>
              <p class="text-muted mb-3"><strong>Província:</strong> <span class="text-info">{{$universidade->municipio->provincia->provincia}}</span></p>
              <a href="{{route('universidade.detalhes',$universidade->id)}}"   class="btn btn-outline-primary btn-sm rounded-3 px-4 py-2">Ver detalhes</a>  
            </div>
          </div>
        </a>
      </div>
@endforeach
{{$universidades->links('vendor.pagination.bootstrap-5')}}
@endif
    </div>
  </div>
</section> 
<script>
   


  document.getElementById('provincia').addEventListener('change', function() {
const provinciaId = this.value;

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
@endsection