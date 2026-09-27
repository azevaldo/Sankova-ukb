
<header id="header" style="background-color: #f0f0f0;" class="header sticky-top">

  <div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">sankovaukb@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+244 938 531 896</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <div class="branding d-flex align-items-center">

    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="">SANKOVA UKB</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="{{$status=='index' ? 'active' : ''}}">Pagina Inicial<br></a></li>
          <li><a  class="{{$status=='sobre' ? 'active' : ''}}"  href="{{route('sobre')}}">Sobre </a></li>
          <li><a href="/#services">Serviços</a></li>
          <li><a  class="{{$status=='uni' ? 'active' : ''}}"  href="{{route('universidades.all')}}">Universidades</a></li>
 
          <li class="dropdown"><a class="{{$status=='diversos' ? 'active' : ''}}" href="#"><span>Diversos</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
        
              <li><a   href="/recomendacao">Recomendações</a></li>
              <li><a    href="/ajuda/simulado">Tutorial Teste</a></li>
              <li><a    href="{{route('contato')}}">Contacto</a></li>

       
       
            </ul>
          </li>

          <li class="dropdown"><a class="{{$status=='usuario' ? 'active' : ''}}" href="#"><span>Usuario</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              
              @role('normal')

              <li><a   href="{{route('profile.edit')}}">Perfil</a></li>
 
              @endrole
              @guest
              <li><a   href="/login">Entrar</a></li>
              <li><a   href="/register">Cadastrar</a></li>
              @else
              <li><a href="{{route('desempenho',Auth::user()->id)}}">Desempenho</a></li>
                @hasanyrole('admin|admin_universidade|admin_faculdade|admin_curso')
                @role('admin')
                <li><a href="{{route('dashboard.main')}}">Painel Controlo</a></li>
                @else
                <li><a href="{{route('dashboard.gestores')}}">Painel Controlo</a></li>
                @endrole
                @endrole
                <li><a href="/register"  data-bs-toggle="modal" data-bs-target="#logoutModal">Sair</a></li>
              @endguest
           
       
       
            </ul>
          </li>
         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>



    </div>

  </div>

</header>
