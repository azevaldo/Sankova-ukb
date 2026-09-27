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
        <h6 class="text-white text-capitalize ps-3">Gestor</h6>
        <h6 class="text-white text-capitalize ps-3">🎓 Painel Geral</h6>
    </div>
</div>
    
<div class="container py-4">
     
        <div class="col-12 text-center">
            <p class="text-muted">Acompanhe as estatísticas do ambiente acadêmico.</p>
        </div>
    </div>

@if(isset($user_universidade) || isset($user_faculdade) || isset($user_curso))
    <div class="row g-4 mb-4">
        @isset($user_universidade)
            <div class="col-md-3 col-sm-6">
                <div class="card universidades">
                    <span class="tag tag-universidades">Faculdade</span>
                    <div class="card-body">
                        <div class="colora">
                            <p class="mb-1">Faculdades</p>
                            <h3>{{$nFaculdades}}</h3>
                        </div>
                        <i class="bi bi-bank icon"></i>
                    </div>
                </div>
            </div>
        @endisset
        
        @if(isset($user_universidade) || isset($user_faculdade))
            <div class="col-md-3 col-sm-6">
                <div class="card faculdades">
                    <span class="tag tag-faculdades">Cursos</span>
                    <div class="card-body">
                        <div class="colora">
                            <p class="mb-1">Cursos</p>
                            <h3>{{$nCursos}}</h3>
                        </div>
                        <i class="bi bi-journal-bookmark icon"></i>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="col-md-3 col-sm-6">
            <div class="card cursos">
                <span class="tag tag-cursos">Disciplinas</span>
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1">Disciplinas</p>
                        <h3>{{$nDisciplinas}}</h3>
                    </div>
                    <i class="bi bi-book icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card estudantes">
                <span class="tag tag-estudantes">Tópicos</span>
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1">Tópicos</p>
                        <h3>{{$nTopicos}}</h3>
                    </div>
                    <i class="bi bi-list-task icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card estudantes">
                <span class="tag tag-estudantes">Subtemas</span>
                <div class="card-body">
                    <div class="colora">
                        <p class="mb-1">Subtemas</p>
                        <h3>{{$nMateriais}}</h3>
                    </div>
                    <i class="bi bi-collection icon"></i>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
@endsection
