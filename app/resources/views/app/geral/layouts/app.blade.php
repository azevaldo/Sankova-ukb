
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SANKOVA UKB</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="/principal/assets/img/favicon.png" rel="icon">
  <link href="/principal/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/principal/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/principal/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/principal/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

 
  <link href="/principal/assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="/principal/assets/css/toastr.min.css"> 
  <style>
    /* Efeito Hover */
    .hover-effect:hover {
        transform: translateY(-10px); /* Move o card para cima */
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
        transition: all 0.3s ease-in-out; /* Suaviza a animação */
    }

    .hover-effect .card-body {
        transition: color 0.3s ease; /* Animação da cor do texto */
    }

    .hover-effect:hover .card-body h5 {
        color: #007bff; /* Muda a cor do título */
    }

    .hover-effect:hover .btn-outline-primary {
        background-color: #007bff; /* Muda o fundo do botão */
        color: white; /* Cor do texto do botão */
    }
    .university-info {
    display: flex;
    justify-content: center; /* Centraliza o conteúdo */
    align-items: center; /* Alinha verticalmente */
    gap: 8px; /* Espaço entre o texto "Província" e o dado */
    font-size: 14px; /* Mantém um tamanho uniforme */
}

</style>
@yield('diretiva')
</head>

<body class="index-page">

  <main class="main">
@include('app.geral.partials.header')
@yield('content')
@include('app.geral.partials.footer')


</main>


<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmação de Saida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem a certeza de que deseja sair?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Sair</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Preloader -->
<div id="preloader"></div>
<script type="text/javascript" src="/principal/assets/js/jquery-3.4.1.min.js"></script>
<!-- Vendor JS Files -->
<script src="/principal/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/principal/assets/vendor/php-email-form/validate.js"></script>
<script src="/principal/assets/vendor/aos/aos.js"></script>
<script src="/principal/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/principal/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/principal/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="/principal/assets/js/main.js"></script>
<script src="/principal/assets/js/toastr.min.js"></script>
@if (session('success'))
<script>
    $(document).ready(function() {
        var o = $("html").attr("data-textdirection") === "rtl";
        toastr.success("{{ session('success') }}", "", {
            closeButton: true,
            tapToDismiss: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            rtl: o
        });
    });
</script>
@endif
@if (session('error'))


<script>
    $(document).ready(function() {
        var o = $("html").attr("data-textdirection") === "rtl";
        toastr.error("{{ session('error') }}", "", {
            closeButton: true,
            tapToDismiss: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            rtl: o
        });
    });
</script>
    
 

@endif
</body>

</html>