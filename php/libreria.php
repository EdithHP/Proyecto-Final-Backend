<?php
  function obtenerInformacion() {
    $archivo = fopen('./data-1.json', 'r');
    $leer = fread($archivo, filesize('../data-1.json'));
    $data = json_decode($leer, true);
    fclose($archivo);
    return $data;
  };

  // Obtener Ciudades y tipos
  function obtenerCiudad($getData) {
    $getCuidades = Array();
    foreach ($getData as $key => $value) {
      if (in_array($value['Ciudad'], $getCuidades)) {
      } else {
        array_push($getCuidades, $value['Ciudad']);
      }
    }
    echo json_encode($getCuidades);
  }

// Obtener Tipos
  function obtenerTipo($getData) {
    $getTipo = Array();
    foreach ($getData as $key => $value) {
      if (in_array($value['Tipo'], $getTipo)) {
      } else {
        array_push($getTipo, $value['Tipo']);
      }
    }
    echo json_encode($getTipo);
  }

  //



  $getData = leerDatos();
  obtenerTipo($getData);
  obtenerCiudad($getData);
 ?>
