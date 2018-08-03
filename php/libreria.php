<?php
  function ObtenerInformacion() {
    $archivo = fopen('./data-1.json', 'r');
    $leer = fread($archivo, filesize('../data-1.json'));
    $data = json_decode($leer, true);
    fclose($archivo);
    return $data;
  }

  $response = array();

  // Obtener Ciudades

  $ciudades = array();
  $tipos = array();
  $response['tituloContenido'] = '<div class="tituloContenido card">
                                    <h5>Resultados de la búsqueda:</h5>
                                    <div class="divider"></div>
                                    <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
                                  </div>';
  foreach ($data as $key => $value) {
    // Seleccionar Ciudades
    $ciudades[$key] = $value['Ciudad'];
    $tipo[$key] = $value['Tipo'];

    $response[$key] = ''
  }
 ?>
