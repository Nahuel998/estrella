<?php
include("incluir.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="images/logo.png" />
  

  <title>Sistema de Stock</title>

</head>

<body id="page-top">
  <!-- Barra de navegacion -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand " href="index.php">Sistema de Stock</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="index.php?pagina=ventas">Ventas<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=productos">Alta de Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=entradas">Entrada de Productos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Reportes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="index.php?pagina=reportesES"><i class="fa fa-fw fa-file-alt"></i>Salida por fecha</a>
            <a class="dropdown-item" href="index.php?pagina=reportesDisponibilidad"><i class="fa fa-list-ul"></i>Disponibilidad</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- ACA VA EL CONTENIDO DENTRO DEL DIV CONTENT-WRAPPER -->
  <div id="content-wrapper">
    <?php
    if (!empty($_GET[pagina])) {
      include("modulos/" . addslashes($_GET[pagina]) . '.php');
    }
    ?>
    <!-- Sticky Footer -->
    <footer class="sticky-footer mt-3">
      <div class="container my-auto" >
        <div class="copyright text-center my-auto">
          <span>NR Desarrollo Web</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->


  <!-- /#wrapper -->

  <script>
    $(document).ready(function() {
      $('li.nav-item.dropdown').click(function() {
        $(this).toggleClass('show');
        $(this).find('div').toggleClass('show');
      });
    });
  </script>

</body>

</html>