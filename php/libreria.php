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

  // Filtrar Datos
  function filtrarDatos($filtroCiudad, $filtroTipo, $filtroPrecio, $data) {
    $itemList = Array();
    if ($filtroCiudad == "" and $filtroTipo == "" and $filtroPrecio == "") {
      foreach ($data as $index => $item) {
        array_paush($itemList, $item);
      }
    } else {
      $menor = $filtroPrecio[0];
      $mayor = $filtroPrecio[1];

        if ($filtroCiudad == "" and filtroTipo == "") {
          foreach ($data as $items => $item) {
            $precio = precioNumero($item['Precio']);
          if ($precio >= $menor and $precio <= $mayor) {
            array_push($itemList, $item);
            }
          }
        }

        if ($filtroCiudad != "" and $filtroTipo == "") {
          foreach ($data as $index => $item) {
            $precio = precioNumero($item['Precio']);
            if ($filtroCiudad == $item['Ciudad'] and $precio > $menor and $precio < $mayor) {
              array_push($itemList, $item);
            }
          }
        }

        if ($filtroCiudad == "" and $filtroTipo != "") {
          foreach ($data as $index => $item) {
            $precio = precioNumero($item['Precio']);
            if ($filtroCiudad == $item['Tipo'] and $precio > $menor and $precio < $mayor) {
              array_push($itemList, $item);
            }
          }
        }

        if ($filtroCiudad != "" and $filtroTipo != "") {
          foreach ($data as $index => $item) {
            $precio = precioNumero($item['Precio']);
            if ($filtroCiudad == $item['Tipo'] and $filtroCiudad == $item['Ciudad'] and $precio > $menor and $precio < $mayor) {
              array_push($itemList, $item);
            }
          }
        }
    }
    echo json_encode($itemList);
  };

  function precioNumero($itemPrecio) {
    $precio = str_replace('$', '', $itemPrecio);
    $precio = str_replace(',', '', $precio);
    return $precio;
    }
  }

 ?>
