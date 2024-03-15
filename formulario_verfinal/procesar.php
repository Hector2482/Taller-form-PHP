<?php
// Establecer conexión con la base de datos
$servername = "sql.freedb.tech:3306";
$username = "freedb_camarinb";
$password = "&7EvWvj9wjyp36T";
$dbname = "freedb_mysqldb";

// Intentar establecer conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    // Registrar el error de conexión
    $logMessage = "Error en la conexión: " . $conn->connect_error . PHP_EOL;
    file_put_contents('db_connection_log.txt', $logMessage, FILE_APPEND);
    die("Error en la conexión: " . $conn->connect_error);
} else {
    // Registrar la conexión exitosa
    $logMessage = "Conexión establecida exitosamente: " . date('Y-m-d H:i:s') . PHP_EOL;
    file_put_contents('db_connection_log.txt', $logMessage, FILE_APPEND);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$ciudad = $_POST['ciudad'];
$pqrs = $_POST['pqrs'];

// Verificar si el usuario ya ha enviado una queja
$sql_select = "SELECT * FROM pqrs WHERE email = '$email'";
$result_select = $conn->query($sql_select);

if ($result_select->num_rows > 0) {
    // El usuario ya ha enviado una queja anteriormente
    echo "Lo siento, usted ya ha enviado una queja con antelación.";
} else {
    // Insertar datos en la base de datos
    echo "Gracias por enviar su PQRS";
    $sql_insert = "INSERT INTO pqrs (nombre, email, ciudad, pqrs) VALUES ('$nombre', '$email', '$ciudad', '$pqrs')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "PQRS enviada correctamente.";
    } else {
        echo "Error al enviar la PQRS: " . $conn->error;
    }
}

$conn->close();
