<?php
require '../banco/banco.php';
require '../usuario/usuario.php';
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ../login/login.php');
    return;
}

$tipo = $_SESSION['usuario'] -> get_tipo();

$usuario =  $_SESSION['usuario'];
$resultado = obterFuncionarios();
$resultadoServico = obterServicos();
?>

<?php
if($tipo == 2){
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link rel="shortcut icon" href="../assets/img/favicon.png">
        <meta charset="UTF-8" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Dashboard do usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../assets/css/dashboard.css" rel="stylesheet">
    </head>
    <body>
        <div id="preloader">
            <div class="inner">
                <div class="bolas">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap">
            <a href="../index.html#home"><img src="../assets/img/logo.png" alt="logo mr barbers" class="nav-logo"></a>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                <a class="nav-link px-3 d-none d-md-block" href="../login/logout.php"><span data-feather="log-out"></span> Sair</a>
                </div>
            </div>
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">            
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">
                        <span data-feather="home"></span>
                        Principal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                        <span data-feather="calendar"></span>
                        Agendamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="scissors"></span>
                        Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="settings"></span>
                        Configurações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/logout.php">
                        <span data-feather="log-out"></span>
                        Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="sidebar col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="dashboard.php">
                                <span data-feather="home"></span>
                                Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="popupAgendamento" data-bs-toggle="modal" data-bs-target="#popupAgendamento">
                                <span data-feather="calendar"></span>
                                Agendar Agora
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <h2>Olá, <?php echo $usuario -> get_nome(); ?>!</h2>
                    <h2>Seus Agendamentos</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Barbearia</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Profissional</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Localização</th>
                                    <th scope="col">WhatsApp</th> 
                                </tr>         
                            </thead>
                                <tr>
                                    <th>05/11/2021</th>
                                    <th>15:30</th>
                                    <th>BARBER SHOP T.H.R</th>
                                    <th>Corta Cabelo(Maquina)</th>
                                    <th>João Pedro</th>
                                    <th style="color: red;">Pendente</th>
                                    <th><a type="button"  target="_blank" href="https://goo.gl/maps/cCSovc5TNAd4Di926" class="btn btn-primary btn-sm">ABRIR MAPA</a></th>
                                    <th> <a type="button" target="_blank" href="https://www.whatsapp.com/?lang=pt_br" class="btn btn-primary btn-sm">Falar Com Profissional</a> </th>
                                </tr> 
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </main>
                <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
                <h2>Agendamentos Anteriores</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Barbearia</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Profissional</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Localização</th>
                                    <th scope="col">WhatsApp</th>
                                </tr>         
                            </thead>
                                <tr>
                                    <th>05/11/2021</th>
                                    <th>15:30</th>
                                    <th>BARBER SHOP T.H.R</th>
                                    <th>Corta Cabelo(Maquina)</th>
                                    <th>João Pedro</th>
                                    <th style="color: green;">Concluído</th>
                                    <th><a type="button"  target="_blank" href="https://goo.gl/maps/cCSovc5TNAd4Di926" class="btn btn-primary btn-sm">ABRIR MAPA</a></th>
                                    <th> <a type="button" target="_blank" href="https://www.whatsapp.com/?lang=pt_br" class="btn btn-primary btn-sm">Falar Com Profissional</a> </th>
                                </tr> 
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </main>

            <main class="conteudo col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="modal fade" id="popupAgendamento" tabindex="-1" aria-labelledby="popupAgendamentoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Faça Seu Agendamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" class="form-agendamento">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-sm-6">
                                            <input type="date" min="<?php echo date('Y-m-d');?>" max="2021-12-25" class="form-control" id="data" placeholder="Data">
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option selected>08:00</option>
                                                <option value="">09:00</option>
                                                <option value="">10:00</option>
                                                <option value="">11:00</option>
                                                <option value="">12:00</option>
                                                <option value="">13:00</option>
                                                <option value="">14:00</option>
                                                <option value="">15:00</option>
                                                <option value="">16:00</option>
                                                <option value="">17:00</option>
                                                <option value="">18:00</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option selected>Serviços</option>
                                                <?php echo $resultadoServico;?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option selected>Profissional</option>
                                                <?php echo $resultado;?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option selected>Barbearias</option>
                                                <option value="">Barber Shop t.h.r</option>
                                                <option value="">Matheus Barber</option>
                                                <option value="">Barbearia Dos Amigos</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="" id="" class="form-select">
                                                <option selected>Unidades</option>
                                                <option value="">Salvador - Parque Bela Vista</option>
                                                <option value="">Itubana - Jardim Primavera</option>
                                                <option value="">Porto Seguro - Baianão</option>
                                                <option value="">Ilhéus - Bela Visão</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Messagem"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>      
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary">Agendar Agora</button>
                            </div>
                        </div>
                     </div>
                </div>                          
            </main>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
            <script src="../assets/js/main.js"></script>
            <script> feather.replace();</script>
        </body>
</html>

<?php
}
?>