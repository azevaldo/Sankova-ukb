@extends("app.office.layouts.templete")

@section('diretiva')
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        font-weight: bold;
        
    }
    .icon {
        font-size: 2.5rem;
        color: #007bff;
        margin-top: 3px;
    }
    .tag {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        font-size: 0.8rem;
        font-weight: bold;
        border-radius: 10px;
        color: white;
    }
    .universidades { background-color: #f8f9fa; }
    .faculdades { background-color: #e9ecef; }
    .cursos { background-color: #dee2e6; }
    .estudantes { background-color: #ced4da; }
    .tag-universidades { background: #007bff; }
    .tag-faculdades { background: #007bff; }
    .tag-cursos { background: #007bff; }
    .tag-estudantes { background: #007bff; }
    .colora{
        color: #007bff;
    }
</style>
@endsection
@section("content")
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mt-2">
    <div class="cabeca shadow-dark border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3">Administrador Geral</h6>
        <h6 class="text-white text-capitalize ps-3">🎓 Painel Geral</h6>
    </div>
</div>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
             
            <p class="text-muted">Acompanhe as estatísticas do ambiente acadêmico.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Universidades -->
        <div class="col-md-3 col-sm-6">
            <div class="card universidades">
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1 text-uppercase">Universidades</p>
                        <h3 >{{$nUniversidades}}</h3>
                    </div>
                    <i  class="bi bi-buildings icon"></i>
                </div>
            </div>
        </div>

        <!-- Faculdades -->
        <div class="col-md-3 col-sm-6">
            <div class="card faculdades">
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1 text-uppercase">Faculdades</p>
                        <h3 >{{$nFaculdades}}</h3>
                    </div>
                    <i  class="bi bi-mortarboard icon"></i>
                </div>
            </div>
        </div>

        <!-- Cursos -->
        <div class="col-md-3 col-sm-6">
            <div class="card cursos">
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1 text-uppercase">Cursos</p>
                        <h3 >{{$nCursos}}</h3>
                    </div>
                    <i  class="bi bi-book icon"></i>
                </div>
            </div>
        </div>

        <!-- Estudantes -->
        <div class="col-md-3 col-sm-6">
            <div class="card estudantes">
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1 text-uppercase">Usuarios Estudantes</p>
                        <h3 >{{$nUsuarios}}</h3>
                    </div>
                    <i  class="bi bi-people icon"></i>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection