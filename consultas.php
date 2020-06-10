<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>almacen</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos/style.css">
</head>
<?php
if (isset($_POST["registrar"])) {
  include("conexion.php");
  $_Nombre = $_POST["nombre"];
  $_Referencia = $_POST["referencia"];
  $_Precio = trim($_POST["precio"]);
  $_Peso = trim($_POST["peso"]);
  $_Categoria = $_POST["categoria"];
  $_Stock = trim($_POST["stock"]);
  try {
    $sql = "SELECT  * FROM stock WHERE Nombre_producto=?";
    $consulta = $conex->prepare($sql);
    $consulta->execute([$_Nombre]);
    if ($consulta->rowCount() == 0) {
      $sql1 = "INSERT INTO stock (Nombre_producto,Referencia,Precio,Peso,Categoria,Stock) VALUES (?,?,?,?,?,?)";
      $resultado = $conex->prepare($sql1);
      $resultado->execute([$_Nombre, $_Referencia, $_Precio, $_Peso, $_Categoria, $_Stock]);
      header("location:index.php");
    } else {
      echo "
          <!-- modal de boostrap -->
          <div class='modal' tabindex='-1' role='dialog' id='myModal'>
              <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                      <div class='modal-header'>
                          <h5 class='modal-title'>ADVERTENCIA</h5>
                      </div>
                      <div class='modal-body'>
                          <p> No se registro el producto por duplicidad.</p>
                      </div>
                      <div class='modal-footer'>
                          <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                      </div>
                  </div>
              </div>
          </div>
      ";
    }
  } catch (PDOException $e) {
    echo "Error::" . $e->getMessage();
  }
}
if (isset($_POST["Editar"])) {
  include("conexion.php");
  $_Id = $_POST["id"];
  $_Nombre = $_POST["nombre"];
  $_Referencia = $_POST["referencia"];
  $_Precio = trim($_POST["precio"]);
  $_Peso = trim($_POST["peso"]);
  $_Categoria = $_POST["categoria"];
  $_Stock = trim($_POST["stock"]);
  try {
    $sql1 = "UPDATE stock SET Nombre_producto=?,Referencia=?,Precio=?,Peso=?,Categoria=?,Stock=? WHERE Id=' $_Id'";
    $stmt = $conex->prepare($sql1);
    $stmt->execute([$_Nombre, $_Referencia, $_Precio, $_Peso, $_Categoria, $_Stock]);
    if ($stmt->rowCount() > 0) {
      echo "
      <!-- modal de boostrap -->
      <div class='modal' tabindex='-1' role='dialog' id='myModal'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title'>EXITO</h5>
                  </div>
                  <div class='modal-body'>
                      <p> Se modifico correctamente.</p>
                  </div>
                  <div class='modal-footer'>
                      <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                  </div>
              </div>
          </div>
      </div>
  ";
    } else {
      echo "
      <!-- modal de boostrap -->
      <div class='modal' tabindex='-1' role='dialog' id='myModal'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title'>ADVERTENCIA</h5>
                  </div>
                  <div class='modal-body'>
                      <p> algo salio mal, o no se modifico ningun campo.</p>
                  </div>
                  <div class='modal-footer'>
                      <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                  </div>
              </div>
          </div>
      </div>
  ";
    }
  } catch (PDOException $e) {
    echo "Error::" . $e->getMessage();
  }
}
if (!empty($_GET["dato1"])) {
  include("conexion.php");
  if ($_GET["dato1"] == "Borrar") {
    $_Id =  $_GET["dato2"];
    $query = "DELETE  FROM stock WHERE Id ='$_Id'";
    $resultado = $conex->query($query);
    if ($resultado->rowCount() > 0) {
      echo "
      <!-- modal de boostrap -->
      <div class='modal' tabindex='-1' role='dialog' id='myModal'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title'>EXITO</h5>
                  </div>
                  <div class='modal-body'>
                      <p>el producto se elimino correctamete.</p>
                  </div>
                  <div class='modal-footer'>
                      <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                  </div>
              </div>
          </div>
      </div>
  ";
    } else {
      echo "
      <!-- modal de boostrap -->
      <div class='modal' tabindex='-1' role='dialog' id='myModal'>
          <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 class='modal-title'>ADVERTENCIA</h5>
                  </div>
                  <div class='modal-body'>
                      <p> El producto ya no existe.</p>
                  </div>
                  <div class='modal-footer'>
                      <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                  </div>
              </div>
          </div>
      </div>
  ";
    }
  }
}
if (isset($_POST["compra"])) {
  include("conexion.php");
  $_Id = $_POST["id"];
  $_Cantidad = $_POST["cantidad"];
  $_Fecha = $_POST["fecha"];
  $Resta = 0;

  $sql2 = "SELECT * FROM stock  WHERE Id='$_Id'";
  $resultado1 = $conex->query($sql2);
  while ($row = $resultado1->fetch()) {
    $Stock = $row["Stock"];
  }
  if ($Stock ==0) {
    echo "
    <!-- modal de boostrap -->
    <div class='modal' tabindex='-1' role='dialog' id='myModal'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>ADVERTENCIA</h5>
                </div>
                <div class='modal-body'>
                    <p>No hay productos en el stock.</p>
                </div>
                <div class='modal-footer'>
                    <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                </div>
            </div>
        </div>
    </div>
";
  }else{
  if ($Stock >= $_Cantidad) {
   echo $Resta = $Stock - $_Cantidad;
    $sql1 = "UPDATE stock SET Stock=?, fech_venta=? WHERE Id=' $_Id'";
    $stmt = $conex->prepare($sql1);
    $stmt->execute([$Resta,$_Fecha]);
    if ($stmt->rowCount() > 0) {
      echo "
    <!-- modal de boostrap -->
    <div class='modal' tabindex='-1' role='dialog' id='myModal'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>EXITO</h5>
                </div>
                <div class='modal-body'>
                    <p>La Compra fue un exito.</p>
                </div>
                <div class='modal-footer'>
                    <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                </div>
            </div>
        </div>
    </div>
";
    } else {
      echo "
    <!-- modal de boostrap -->
    <div class='modal' tabindex='-1' role='dialog' id='myModal'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>ADVERTENCIA</h5>
                </div>
                <div class='modal-body'>
                    <p> algo salio mal, o no se modifico ningun campo.</p>
                </div>
                <div class='modal-footer'>
                    <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
                </div>
            </div>
        </div>
    </div>
";
    }
  } else {

    echo "
  <!-- modal de boostrap -->
  <div class='modal' tabindex='-1' role='dialog' id='myModal'>
      <div class='modal-dialog' role='document'>
          <div class='modal-content'>
              <div class='modal-header'>
                  <h5 class='modal-title'>ADVERTENCIA</h5>
              </div>
              <div class='modal-body'>
                  <p> se supero el maximo de lo que hay en el stock.</p>
              </div>
              <div class='modal-footer'>
                  <a href='index.php'><button type='button' class='btn btn-secondary'>regresar</button></a>
              </div>
          </div>
      </div>
  </div>
";
  }
}
}

?>
</body>
<script src="jquery.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(window).on('load', function() {
    $('#myModal').modal('show');
  });
</script>

</html>
