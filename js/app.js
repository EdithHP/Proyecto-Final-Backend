$(function() {
  obtenerCiudad();
  obtenerTipo();
})

$('#mostrarTodos').on('click', function() {
  buscarItem(false);
})

$('#formulario').on('submit', function(event) {
  event.preventDefault();
  buscarItem(true);
})

function obtenerCiudad() {
  $.ajax ({
    url: './php/cuidad.php',
    type: 'GET',
    data: {},
    success: function(listaCiudades) {
      listaCiudades = validarJson(listaCiudades, 'Ciudad')
      $.each(listaCiudades, function(index, value) {
        $('#selectCiudad').append('<option value="' +value+ '">' +value+ '</option>')
      });
    }
  })
}

function obtenerTipo(){
  $.ajax ({
    url: './php/tipo.php',
    type: 'GET'
    data: {},
    success: function(listaTipo) {
      listaTipo = validarJson(listaTipo, 'Tipo')
      $.each(listaTipo, function(index, value) {
        $('#selectTipo').append('<option value="' +value+ '">' +value+ '</option>')
      });
    },
  }).done(function() {
    $('select').material_select();
  })
}

function validarJson(validarJson, lista) {
  try {
    var validarJson = JSON.parse(validarJson)
    return validarJson
  } catch (e) {
    obtnError('', 'SyntaxError' +lista);
  }
}

function buscarItem(filtrar) {
  if ($('.colContenido > .item') !=0) {
    $('.colContenido > .item').detach()
  }
  var filtro = obtFiltros(filtrar)
  $.ajax({
    utrl: '/php/filtros.php',
    type: 'GET',
    data: {filtro},
    success: function(items, textStatus, errorThrown) {
      try {
        item = JSON.parse(items):
      } catch (e) {
        obtnError(500, 'SyntaxError');
      }
      $.each(item, function(index, item) {
        $('colContenido').append(
          '<div class="col s12 item">' +
            '<div class="card itemMostrado">' +
              '<img src"./img/home.jpg">' +
                '<div class="card-stacked">' +
                  '<p><strong>Dirección: </strong>' +item.Direccion+ '</p>' +
                  '<p><strong>Ciudad: </strong>' +item.Ciudad+ '</p>' +
                  '<p><strong>Teléfono: </strong>' +item.Telefono+ '</p>' +
                  '<p><strong>Código Postal: </strong>' +item.Codigo_Postal+ '</p>' +
                  '<p><strong>Tipo: </strong>' +item.Tipo+ '</p>' +
                  '<p><strong>Precio: </strong><span class="precioTexto">' +item.Precio+ '</span></p>' +
                '<div class="divider"></div>' +
                '<div class="card-action">VER MAS</div>' +
                '</div>' +
            '</div>' +
          '</div>'
        )
      })
    },
  }).done(function() {
    var totalItems = $('.colContenido > .item').length
    $('.tituloContenido.card > h5').text("Resultados de la búsqueda: " +totalItems+ "items")
  }).fail(function(jqXHR, textStatus, errorThrown){
    obtnError(jqXHR, textStatus)
  })
}

function obtnFiltros(filtrar) {
  var rango = $('#rangoPrecio').val(),
  rango = rango.split(";")
  if (filtrar == false) {
    var obtnCiudad = '',
        obtnTipo = '',
        obtnPrecio = ''
  } else {
    var obtnCiudad = $('#selectCiudad option:selected').val(),
        obtnTipo = $('#selectTipo option:selected').val(),
        obtnPrecio = rango
  }

  var filtro = {
    Precio: obtnPrecio,
    Ciudad: obtnCiudad,
    Tipo: obtnTipo
  }
  return filtro;
}
