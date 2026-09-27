<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/office2/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/office2/assets/img/favicon.png">
  <title>
   SANKOVA UKB
  </title>
<!-- CSS do Bootstrap -->

<link id="pagestyle" href="/office2/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" /> 
 
 <!--     Fonts and icons     -->

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->

  <link href="/office2/assets/css/nucleo-icons.css" rel="stylesheet" />

  <link href="/office2/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
 


  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link href="/principal/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/principal/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/principal/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/principal/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

 
  <link href="/principal/assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="/principal/assets/css/toastr.min.css"> 
  <style>
    .cabeca{
     background-color: #1b75d6;
     color: white;
    }
    .cabeca2{
     background-color: #1b75d6;
     color: white;
    }

    .cabeca2:hover{
     background-color: #244f7e;
     color: white;
    }
    .adicionar {
        font-size: 20px; /* Ajuste o tamanho conforme necessário */
    }
    .vizualizar {
        color: rgb(58, 117, 19) /* Ajuste o tamanho conforme necessário */
    }
    .lista {
        color: rgb(24, 23, 112) /* Ajuste o tamanho conforme necessário */
    }
    .menu-item {
        transition: all 0.3s ease-in-out;
    }

    .menu-item:hover {
        background-color: #007bff !important;
        color: white !important;
    }
  </style>
@yield('diretiva')
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="/" >
        <img src="/office2/assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">SANKOVA UKB </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
   
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @role('admin')
        <li class="nav-item">
            <a class="nav-link active text-white" href="/dashboard/main" style="background-color: #007bff;">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link active text-white" href="/dashboard/gestores" style="background-color: #007bff;">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        @endrole
    
        @role('admin')
        <li class="nav-item">
            <a class="nav-link text-dark menu-item" href="{{route('universidades.index')}}">
                <i class="bi bi-building"></i>
                <span class="nav-link-text ms-1">Universidades</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark menu-item" href="{{route('provincias.index')}}">
              <i class="bi bi-building"></i>
              <span class="nav-link-text ms-1">Provincias</span>
          </a>
      </li>
        @endrole
    
        @role('admin_universidade')
        <li class="nav-item">
            <a class="nav-link text-dark menu-item" href="{{route('faculdade.index2', Auth::user()->entidade->id)}}">
                <i class="bi bi-mortarboard"></i>
                <span class="nav-link-text ms-1">Faculdades</span>
            </a>
        </li>
        @endrole
    
        @role('admin_faculdade')
        <li class="nav-item">
            <a class="nav-link text-dark menu-item" href="{{route('curso.index2', Auth::user()->entidade->id)}}">
                <i class="bi bi-book"></i>
                <span class="nav-link-text ms-1">Cursos</span>
            </a>
        </li>
        @endrole
    
        @role('admin_curso')
        <li class="nav-item">
            <a class="nav-link text-dark menu-item" href="{{route('disciplina.index2', Auth::user()->entidade->id)}}">
                <i class="bi bi-journal"></i>
                <span class="nav-link-text ms-1">Disciplinas</span>
            </a>
        </li>
        @endrole
  

          @hasanyrole("admin|admin_universidade|admin_faculdade")
          <li class="nav-item">
              <a class="nav-link text-dark d-flex justify-content-between align-items-cente menu-item" data-bs-toggle="collapse" href="#universidadesMenu" role="button" aria-expanded="false" aria-controls="universidadesMenu">
                  <span>
                      <i class="bi bi-shield-lock"></i>
                      <span class="nav-link-text ms-1">Permissões</span>
                  </span>
                  <i class="bi bi-chevron-down expand-icon"></i>
              </a>
              
              <div class="collapse ps-3" id="universidadesMenu">
                <ul class="nav flex-column">
                  @role('admin') 
                  <li class="nav-item">
                      <a class="nav-link text-dark menu-item" href="{{route('permissoes.universidades')}}">
                          <i class="fas fa-university me-2"></i> Listar Universidades
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-dark menu-item" href="{{route('permissoes.adm')}}">
                          <i class="fas fa-user-shield me-2"></i> Adm Permissões
                      </a>
                  </li>
                  @endrole
              
                  @role('admin_universidade') 
                  <li class="nav-item">
                      <a class="nav-link text-dark menu-item" href="{{ route('permissoes.universidade.faculdades', Auth::user()->entidade->id)}}">
                          <i class="fas fa-building me-2"></i> Listar Faculdades
                      </a>
                  </li>
                  @endrole
              
                  @role('admin_faculdade') 
                  <li class="nav-item">
                      <a class="nav-link text-dark menu-item" href="{{route('permissoes.universidade.faculdade.cursos', Auth::user()->entidade->id)}}">
                          <i class="fas fa-book-open me-2"></i> Listar Cursos
                      </a>
                  </li>
                  @endrole
              </ul>
              
              </div>
          </li>
          @endhasanyrole
          <li class="nav-item mt-3">
              <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Outras Páginas</h6>
          </li>
          <li class="nav-item">
              <a class="nav-link text-dark menu-item" href="/profile">
                  <i class="bi bi-person"></i>
                  <span class="nav-link-text ms-1">Perfil</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-dark menu-item" href="/office2/pages/sign-up.html" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <i class="bi bi-box-arrow-right"></i>
                  <span class="nav-link-text ms-1">Sair</span>
              </a>
          </li>
      </ul>
  </div>
    
  
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
         </div>
    </div>
  </aside>
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gestor</a></li>
            @role('admin')
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Geral Do Sistema</li>
          @endrole
          @role('admin_universidade')
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Universidade : {{Auth::user()->entidade->nome}}</li>
        @endrole
        @role('admin_faculdade')
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Faculdade : {{Auth::user()->entidade->nome}} ({{Auth::user()->entidade->universidade->nome}})</li>
      @endrole
      @role('admin_curso')
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Curso : {{Auth::user()->entidade->nome}} ({{Auth::user()->entidade->faculdade->nome}})</li>
    @endrole
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                  <span class="input-group-text"><i class="bi bi-search"></i></span>
                  <input type="text" class="form-control" placeholder="Pesquisar...">
              </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center justify-content-end">
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                  <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                      <i class="bi bi-list"></i>
                  </a>
              </li>
              <li class="nav-item px-3 d-flex align-items-center">
                  <a href="javascript:;" class="nav-link text-body p-0">
                      <i class="bi bi-gear"></i>
                  </a>
              </li>
              <li class="nav-item dropdown pe-3 d-flex align-items-center">
                  <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-bell"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                      <li class="mb-2">
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                              <div class="d-flex py-1">
                                  <div class="my-auto">
                                      <img src="/office2/assets/img/team-2.jpg" class="avatar avatar-sm me-3 ">
                                  </div>
                                  <div class="d-flex flex-column justify-content-center">
                                      <h6 class="text-sm font-weight-normal mb-1">
                                          <span class="font-weight-bold">Nova mensagem</span> de Laur
                                      </h6>
                                      <p class="text-xs text-secondary mb-0">
                                          <i class="bi bi-clock me-1"></i>
                                          13 minutos atrás
                                      </p>
                                  </div>
                              </div>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item d-flex align-items-center">
                  <a href="" class="nav-link text-body font-weight-bold px-0">
                      <i class="bi bi-person-circle"></i>
                  </a>
              </li>
          </ul>
      </div>
      
      </div>
    </nav>


@yield('content')





    <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                SANKOVA UKB <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">INOVAÇÃO</a>
                TECNOLOGICA.
              </div>
            </div>
          
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0"> Configurações Em Progresso</h5>
          <p>Brevemente.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">


 

    </div>
  </div>
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmação de Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem a certeza de que deseja sair?
            </div>
            <div class="modal-footer">

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Sair</button>
                </form>
            </div>
        </div>
    </div>
</div>

 
  <!--   Core JS Files   -->
  <!-- JS do Bootstrap com Popper.js -->
  <script type="text/javascript" src="/principal/assets/js/jquery-3.4.1.min.js"></script>


  <script src="/office2/assets/js/core/popper.min.js"></script>
  <script src="/office2/assets/js/core/bootstrap.min.js"></script>
  <script src="/office2/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/office2/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="/office2/assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Views",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#43A047",
          data: [50, 45, 22, 28, 50, 60, 76],
          barThickness: 'flex'
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: '#e5e5e5'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
              color: "#737373"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
        datasets: [{
          label: "Sales",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function(context) {
                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return fullMonths[context[0].dataIndex];
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Tasks",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#737373',
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [4, 4]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
 <script>
  // Código para alternar o ícone de expansão sempre que o item de menu for clicado
  document.addEventListener('DOMContentLoaded', function () {
      // Seleciona todos os links com a classe data-bs-toggle="collapse"
      const collapseLinks = document.querySelectorAll('[data-bs-toggle="collapse"]');

      collapseLinks.forEach(function (link) {
          link.addEventListener('click', function () {
              const collapseIcon = link.querySelector('.expand-icon');
              const target = document.querySelector(link.getAttribute('href')); // Pega o ID do submenu

              // Alterna o ícone sempre que o menu for expandido ou colapsado
              if (target.classList.contains('show')) {
                  collapseIcon.innerHTML = 'expand_less'; // Se o submenu estiver visível, mostra 'expand_less'
              } else {
                  collapseIcon.innerHTML = ''; // Se o submenu estiver oculto, mostra 'expand_more'
              }
          });
      });
  });
</script>
  <!--  -->
  
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/office2/assets/js/material-dashboard.min.js?v=3.2.0"></script>
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