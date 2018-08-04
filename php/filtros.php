<?php
  require('./php/libreria.php');
  $filtroCiudad = $_GET['filtro']['Ciudad'];
  $filtroTipo = $_GET['filtro']['Tipo'];
  $filtroPrecio = $_GET['filtro']['Precio'];
  $getData = obtenerInformacion();

  filtrarDatos($filtroCiudad, $filtroTipo, $filtroPrecio, $getData);

 ?>
