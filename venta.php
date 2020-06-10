<div class="col-md-9 col-xs-12">

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"> Producto</th>
            <th scope="col">Referencia</th>
            <th scope="col">Precio</th>
            <th scope="col">Peso</th>
            <th scope="col">Categoria</th>
            <th scope="col">Stock</th>
            <th scope="col"> Creación</th>
            <th scope="col"> última venta</th>
            <th scope="col"> Comprar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        date_default_timezone_set("America/Bogota");

        include("conexion.php");
        $cont = 1;
        $sql = "SELECT  * FROM stock  ";
        $resultado = $conex->query($sql);
        while ($row = $resultado->fetch()) {
            $Id = $row["Id"];
            $Nombre = $row["Nombre_producto"];
            $Referencia = $row["Referencia"];
            $Precio = $row["Precio"];
            $Peso = $row["Peso"];
            $categoria = $row["Categoria"];
            $Stock = $row["Stock"];
            $fech_creacion = $row["Fech_creacion"];
            $fech_venta = $row["fech_venta"];
            echo '
                <tr>
                <th scope="row">' . $cont . '</th>
                <td>' . $Nombre . '</td>
                <td>' . $Referencia . '</td>
                <td>' . $Precio . '</td>
                <td>' . $Peso . ' K</td>
                <td>' . $categoria . '</td>
                <td>' . $Stock . '</td>
                <td>' . $fech_creacion . '</td>
                <td>' . $fech_venta . '</td>
                <td><button  type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modeled' . $Id . '">Comprar</button>
                    <!-- Modal -->
                    <div class="modal fade" id="modeled' . $Id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Producto: ' . $Nombre . '</h5>
                                </div>
                                <form action="consultas.php" method="POST" >
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" name="cantidad" class="form-control border-dark" id="cantidad" required>
                                        </div>
                                       
                                        <div class="form-group">
                                            <input type="text" name="id" id="id" class="form-control border-dark" id="codigo" value="' . $Id . '" >
                                        </div>
                                        <div class="form-group">
                                           <input type="text" name="fecha" id="id" class="form-control border-dark" id="codigo" value="' . date("Y-m-d H:i:s")  . '" >
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit"  name="compra" class="btn btn-success">Realizar Compra</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
               
                
                </tr>
            ';
            $cont = $cont + 1;
        }
        if (isset($_POST["Editar"])) {
        ?>
            <style>
                #id {
                    background: aliceblue;

                    color: black;
                }
            </style>
        <?php
        }
        
        ?>
    </tbody>
</table>

</div>
</div>
