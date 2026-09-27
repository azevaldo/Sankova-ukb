@extends($referencia,["status"=>"Perfil"])

@section("content")

 
 

    <div class="py-4">
        <div class="container">
            <div class="row">
                <!-- Update Profile Information Form -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @include('app.geral.usuario.secreto.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

      <!-- Update Password Form -->
      <div class="col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                @include('app.geral.usuario.secreto.partials.update-password-form')
            </div>
        </div>
    </div>

    
            </div>
        </div>
    </div>
 
    
@endsection