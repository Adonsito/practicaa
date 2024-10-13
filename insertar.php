<?php
// Incluir el archivo de conexión a la base de datos
include 'ejecucion.php';

// Verificar si el método de solicitud es POST, lo que indica que se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los valores del formulario enviados mediante POST
    $nombre_tienda = $_POST['nombre_tienda'];
    $numero_telefono = $_POST['numero_telefono'];
    $nombre_producto = $_POST['nombre_producto'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $cantidad_producto = $_POST['cantidad'];
    $tipo_producto = $_POST['tipo_de_producto'];
    $ubicacion_tienda = $_POST['ubicacion_tienda'];

    // Validar que todos los campos estén completos
    if (!empty($nombre_tienda) && !empty($numero_telefono) && !empty($nombre_producto) && !empty($fecha_vencimiento) && !empty($cantidad_producto) && !empty($tipo_producto) && !empty($ubicacion_tienda)) {

        // Validar la fecha en formato YYYY-MM-DD
        $date = DateTime::createFromFormat('Y-m-d', $fecha_vencimiento);
        if (!$date || $date->format('Y-m-d') !== $fecha_vencimiento) {
            echo "Fecha no válida. Debe estar en formato YYYY-MM-DD.";
            exit();
        }

        // Validar que el número de teléfono solo contenga dígitos
        if (!preg_match('/^[0-9]+$/', $numero_telefono)) {
            echo "Número de teléfono no válido. Solo se permiten números.";
            exit();
        }

        // Preparar la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO tienda (nombre_tienda, numero_telefono, nombre_producto, fecha_vencimiento, cantidad_producto, tipo_de_producto, ubicacion_tienda) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia SQL utilizando la conexión a la base de datos
        if ($stmt = mysqli_prepare($conn, $sql)) {

            // Vincular los parámetros a la declaración preparada
            mysqli_stmt_bind_param($stmt, "sssssss", $nombre_tienda, $numero_telefono, $nombre_producto, $fecha_vencimiento, $cantidad_producto, $tipo_producto, $ubicacion_tienda);

            // Ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {
                // Si la inserción es exitosa, redirigir al usuario a la página index.php
                header("Location: index.php");
                exit(); // Detener la ejecución del script después de la redirección
            } else {
                // Si hay un error al ejecutar la declaración, mostrar un mensaje de error
                echo "Error al insertar los datos: " . mysqli_error($conn);
            }

            // Cerrar la declaración preparada para liberar los recursos
            mysqli_stmt_close($stmt);
        } else {
            // Si hay un error al preparar la declaración, mostrar un mensaje de error
            echo "Error al preparar la declaración: " . mysqli_error($conn);
        }
    } else {
        // Si algún campo está vacío, mostrar un mensaje de advertencia
        echo "Por favor, completa todos los campos.";
    }
}

// Cerrar la conexión a la base de datos al finalizar
mysqli_close($conn);
?>
