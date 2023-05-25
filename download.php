<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la URL del archivo MP3 desde el formulario
    $url = $_POST['urlInput'];

    // Validar la URL (puedes agregar más validaciones si lo deseas)
    if (empty($url)) {
        echo "Por favor, ingresa una URL válida.";
        exit;
    }

    // Descargar el archivo MP3
    $nombreArchivo = basename($url);
    $rutaDescarga = 'archivos/' . $nombreArchivo;

    if (file_put_contents($rutaDescarga, file_get_contents($url))) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Content-Length: ' . filesize($rutaDescarga));
        readfile($rutaDescarga);
        unlink($rutaDescarga);
        exit;
    } else {
        echo "Hubo un error al descargar el archivo.";
        exit;
    }
}
?>
