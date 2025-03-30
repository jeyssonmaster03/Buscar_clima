<?php
$apiKey = "101346812e9fc1c4fba53ecae1bfdd46";  
$ciudad = urlencode(isset($_GET["ciudad"]) ? $_GET["ciudad"] : "Santiago");

$url = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=$apiKey&units=metric&lang=es";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respuesta = curl_exec($ch);
curl_close($ch);

$datos = json_decode($respuesta, true);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Clima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <a href="index.html" class="btn btn-secondary mb-4">⬅️ Volver</a>

    <?php if ($datos["cod"] == 200): ?>
        <div class="card shadow-sm p-4">
            <h2 class="mb-3">🌍 Clima en <?= $datos["name"] ?></h2>
            <p><strong>Descripción:</strong> <?= ucfirst($datos["weather"][0]["description"]) ?></p>
            <p><strong>Temperatura:</strong> <?= $datos["main"]["temp"] ?> °C</p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            ❌ No se pudo obtener la información del clima.
        </div>
    <?php endif; ?>
</div>
</body>
</html>
