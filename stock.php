<div class="stock">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <form action="Consultas.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="referencia">Referencia</label>
                    <input type="text" class="form-control" id="referencia" name="referencia" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>
                <div class="form-group">
                    <label for="peso">Peso</label>
                    <input type="number" class="form-control" id="peso" name="peso" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <button name="registrar" class="btn btn-outline-success my-2 my-sm-0" type="submit">Registrar</button>
            </form>
        </div>
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
                        <th scope="col"> Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                            <td><button  type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modeled' . $Id . '">Editar</button>
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
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control border-dark" id="nombre" value="' . $Nombre . '" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="referencia">Referencia</label>
                                                        <input type="text" name="referencia" class="form-control border-dark" id="referencia" value="' . $Referencia . '" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="precio">Precio</label>
                                                        <input type="text" name="precio" class="form-control border-dark" id="precio" value="' . $Precio . ' " required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="peso">Peso</label>
                                                        <input type="text" name="peso" class="form-control border-dark" id="peso" aria-describedby="emailHelp" value="' . $Peso . '" required>
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="categoria">Categoria</label>
                                                        <input type="text" name="categoria" class="form-control border-dark" id="categoria" aria-describedby="emailHelp" value="' . $categoria . '" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stock">Stock</label>
                                                        <input type="text" name="stock" class="form-control border-dark" id="stock" aria-describedby="emailHelp" value="' . $Stock . '" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="id" id="id" class="form-control border-dark" id="codigo" value="' . $Id . '" >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit"  name="Editar" class="btn btn-success">Guarar cambios</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td> <a href="consultas.php?&dato1=Borrar&dato2=' . $Id . '"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
                            
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
</div>
