<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="lib/bootstrap-4.0.0_lite/css/bootstrap.min.css" type="text/css">
  <title>Paginacion Get</title>
</head>

<body>
  <?require("layout/head.php")?>

  <div class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-xl-9 col-md-9">
            <br>
            <h2 align="center">Buscador de Libros</h2>
            <br>
            <div class="form-inline">
              <select id='tipo' class="form-control col-2">
                <option value='titulo'>Titulo</option>
                <option value='codigo'>Codigo</option>
                <option value='autor'>Autor</option>
                <option value='editorial'>Editorial</option>
              </select>
            
              <input type='text' class="form-control col-8" id='wordSearch' size='8' autofocus="true" placeholder="Ingrese texto aqui para buscar" onclick="">
              
              <button onclick='buscar()' class="
            btn btn-primary col-2">Buscar</button>
            </div>
          </div>
        </div>
        <hr>
        <div class="row justify-content-center">
          <div class="col-12 col-xl-9 col-md-9">
            <small id='message'></small>
            <table class='table table-striped'>
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Titulo</th>
                  <th>Autor</th>
                  <th>Editorial</th>
                  <th>Ejemplares</th>
                  <th>Actión</th>
                </tr>
              </thead>
              <tbody id="rowsResults">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal - View Book -->
    <div class="modal fade" id="infoBook_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">DETALLE DE LIBRO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class='table'>
              <tr>
                <td>ID_LIBRO</td>
                <td id='id_libro_modal'></td>
              </tr>
              <tr>
                <td>CODIGO</td>
                <td id='codigo_modal'></td>
              </tr>
              <tr>
                <td>TITULO</td>
                <td id='titulo_modal'></td>
              </tr>
              <tr>
                <td>AUTOR</td>
                <td id='autor_modal'></td>
              </tr>
              <tr>
                <td>EDITORIAL</td>
                <td id='editorial_modal'></td>
              </tr>
              <tr>
                <td>EJEMPLARES</td>
                <td id='ejemplares_modal'></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ocultar</button>
          </div>
        </div>
      </div>
    </div>
  <script src="js/jquery-3.2.1.js"></script>
  <script src="lib/bootstrap-4.0.0_lite/js/popper.min.js"></script>
  <script src="lib/bootstrap-4.0.0_lite/js/bootstrap.min.js"></script>
  <script>
  	$(document).ready(function() {
      buscar();
      $("#wordSearch").keyup(function(event) {
        console.log(event.keyCode);
        if(event.keyCode == 13){
          buscar();
        }
      });
    });

    function buscar(){
      $("#rowsResults").html("");
      $.post("consulta.php",{
        action: "buscar"
        ,word: $("#wordSearch").val()
        ,tipo: $("#tipo").val()
      },function(res){
        console.log(res);
        for( i in res ){
          row ='<tr>'
              +'  <td>'+res[i].codigo+'</td>'
              +'  <td>'+res[i].titulo+'</td>'
              +'  <td>'+res[i].autor+'</td>'
              +'  <td>'+res[i].editorial+'</td>'
              +'  <td>'+res[i].ejemplares+'</td>'
              +'  <td> '
              +'<a href="nuevo_libro.php?edit='+res[i].id_libro+'"><i class="fa fa-pencil-square-o text-warning" aria-hidden="true"></i></a> &nbsp;&nbsp;'
              +'<i class="fa fa-times text-danger" aria-hidden="true" onclick="eliminar('+res[i].id_libro+')" style="cursor:pointer;"></i> </td>'
              +'</tr>';
          $("#rowsResults").append(row);
        }

        $("#wordSearch").select();
      },"json");
    }
    function eliminar(id){
      if( !confirm("¿Usted quiere eliminar este libro?") )
        return;
      
      $.post('consulta.php', {
        action: "eliminar"
        ,id_libro: id
      }, function(res) {
        console.log(res);
        alert(res.message);
        if(res.success){
          //action 001
          window.location.reload();
        }
      },"json");
    }
  </script>
</body>
</html>