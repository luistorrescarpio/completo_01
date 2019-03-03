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

  <div class="section py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          
          <table align='center'  class="table">
            <tr>
              <td colspan="2" align="center">
                <?if(isset($_GET['edit'])):?>
                  <h2 style="color:#6E6E6E;"><b>Edición de Libro</b></h2>
                <?else:?>
                  <h2 style="color:#6E6E6E;"><b>Registro de Libro</b></h2>

                <?endif?>
              </td>
            </tr>
            <tr>
              <th>ID_LIBRO: </th>
              <td>
                <input type='text' id='id_libro' class="form-control" value="" maxlength='30' size='10' disabled>
              </td>
            </tr>
            <tr>
              <th>Codigo: </th>
              <td>
                <input type='text' id='codigo' class="form-control" value="" maxlength='30' size='10'>
              </td>
            </tr>
            <tr>
              <th>Titulo: </th>
              <td>
                <input type='text' id='titulo' class="form-control" value="" maxlength='30'>
              </td>
            </tr>
            <tr>
              <th>Autor: </th>
              <td>
                <select id="autor" class="form-control">
                  <option value='gauss'>Gauss</option>
                  <option value='newton'>Newton</option>
                  <option value='mario'>Mario Vargas LL.</option>
                  <option value='aristoteles'>Aristoteles</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Editorial: </th>
              <td>
                <select id="editorial" class="form-control">
                  <option value='losescritores'>Los escritores</option>
                  <option value='academia'>Academia de Historia</option>
                  <option value='achebe'>Achebe Ediciones</option>
                  <option value='alba'>Alejo Editorial</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>N° Ejemplares: </th>
              <td>
                <input type='number' id='ejemplares' value="" maxlength='30' size="6" class="form-control">
              </td>
            </tr>
            <tr>
              <th>Fecha Registro: </th>
              <td>
                <input type="date" id="fech_registro" value="<?=date("Y-m-d")?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <?if(isset($_GET['edit'])):?>
                <button type="button" class="btn btn-warning" onclick="guardar();">
                  Actualizar
                </button>
                <?else:?>
                <button type="button" class="btn btn-secondary" onclick="guardar();">
                  Registrar
                </button>
                <?endif?>
              </button>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                  <!-- Mensaje de confirmación se imprimira aqui -->
                <div class="alert" role="alert" id="message_rsta" style="display: none;"></div>

              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.2.1.js"></script>
  <script src="lib/bootstrap-4.0.0_lite/js/popper.min.js"></script>
  <script src="lib/bootstrap-4.0.0_lite/js/bootstrap.min.js"></script>
  <script>
  	$(document).ready(function() {
      <?if(isset($_GET['edit'])):?>
        edit(<?=$_GET['edit']?>);
      <?endif?>
    });

    function guardar(){
      $.post("consulta.php",{
        action: "guardar"
        ,id_libro: $("#id_libro").val()
        ,codigo: $("#codigo").val()
        ,titulo: $("#titulo").val()
        ,autor: $("#autor").val()
        ,editorial: $("#editorial").val()
        ,ejemplares: $("#ejemplares").val()
        ,fech_registro: $("#fech_registro").val()
      },function(res){
        console.log(res);
        alert(res.message);
        if(res.success){
          // action 01
          window.location.reload();
        }
      },"json");
    }
    function edit(id){
      $.post("consulta.php",{
        action: "editar"
        ,id_libro: id
      },function(res){
        console.log(res);
        $("#id_libro").val(res.id_libro);
        $("#codigo").val(res.codigo);
        $("#titulo").val(res.titulo);
        $("#autor").val(res.autor);
        $("#editorial").val(res.editorial);
        $("#ejemplares").val(res.ejemplares);
        $("#fech_registro").val(res.fech_registro);
      },"json");
    }
  </script>
</body>
</html>