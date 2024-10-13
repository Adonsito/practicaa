<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Practica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

    
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 15px;
            }

            input[type="text"],
            textarea {
                padding: 8px;
            }

            input[type="submit"] {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-center">
            <div class="form-container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Formulario de Registro</h2>
                    </div>
                    <div class="card-body">
                    <form action="insertar.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="nombre_tienda">Nombre de la Tienda</label>
                            <input type="text" class="form-control" id="nombre_tienda" name="nombre_tienda" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="numero_telefono">Número de Teléfono</label>
                            <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" required pattern="\d+">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nombre_producto">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tipo_de_producto">Tipo de Producto</label>
                            <input type="text" class="form-control" id="tipo_de_producto" name="tipo_de_producto" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ubicacion_tienda">Ubicación de la Tienda</label>
                            <input type="text" class="form-control" id="ubicacion_tienda" name="ubicacion_tienda" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
           
            <div class="spacer"></div>
            <div class="table-container">
                <h3 class="text-center">Datos Registrados</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nombre_tienda</th>
                            <th>numero_telefono</th>
                            <th>nombre_producto</th> 
                            <th>fecha_vencimiento</th>
                            <th>cantidad_producto</th>
                            <th>tipo_de_producto</th>
                            <th>ubicacion_tienda</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                include 'ejecucion.php';

                // Definir la consulta SQL para seleccionar los datos de la tabla
                $sql = "SELECT id, nombre_tienda, numero_telefono, nombre_producto, fecha_vencimiento, cantidad_producto, tipo_de_producto, ubicacion_tienda FROM tienda";
                
                // Ejecutar la consulta en la base de datos y almacenar el resultado en la variable $result
                $result = $conn->query($sql);
                
                // Verificar si el número de filas del resultado es mayor a 0, lo que significa que hay datos
                if ($result->num_rows > 0) {
                    // Recorrer cada fila del resultado usando un bucle while
                    while($row = $result->fetch_assoc()) {
                        // Imprimir una fila de la tabla HTML con los datos obtenidos
                        echo "<tr>
                                <td>" . htmlspecialchars($row["id"]) . "</td>
                                <td>" . htmlspecialchars($row["nombre_tienda"]) . "</td>
                                <td>" . htmlspecialchars($row["numero_telefono"]) . "</td>
                                <td>" . htmlspecialchars($row["nombre_producto"]) . "</td>
                                <td>" . htmlspecialchars($row["fecha_vencimiento"]) . "</td>
                                <td>" . htmlspecialchars($row["cantidad_producto"]) . "</td>
                                <td>" . htmlspecialchars($row["tipo_de_producto"]) . "</td>
                                <td>" . htmlspecialchars($row["ubicacion_tienda"]) . "</td>
                              </tr>";
                    }
                } else {
                    // Si no hay datos en la tabla, mostrar una fila con el mensaje "No hay datos registrados"
                    echo "<tr><td colspan='8' class='text-center'>No hay datos registrados</td></tr>";
                }
                
                // Cerrar la conexión con la base de datos una vez que se haya completado el procesamiento
                $conn->close();
                ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script&gt;
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script&gt;
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script&gt;
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                }
            });
        });
    </script>
</body>
</html>