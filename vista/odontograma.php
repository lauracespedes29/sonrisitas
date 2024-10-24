<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odontograma del Paciente</title>
    <?php include_once 'layouts/header.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Fondo blanco */
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .odontograma {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .fila {
            display: flex;
            justify-content: center;
            margin-bottom: 20px; /* Más espacio entre filas */
        }

        .diente {
            cursor: pointer;
            margin: 0 15px; /* Espacio entre los dientes */
            position: relative; /* Para el texto emergente */
            transition: transform 0.3s, box-shadow 0.3s; /* Efecto de sombra */
            text-align: center; /* Centrar el número debajo de la imagen */
        }

        .diente img {
            width: 80px; /* Aumentar tamaño */
            height: 80px; /* Aumentar tamaño */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
        }

        /* Estado de los dientes */
        .diente-sano img { border: 2px solid lightgreen; }
        .diente-caries img { border: 2px solid red; }
        .diente-tratado img { border: 2px solid orange; }
        .diente-extraccion img { border: 2px solid gray; }

        /* Efecto al pasar el mouse */
        .diente:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .central {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.2em; /* Aumentar tamaño de texto */
        }

        /* Tooltip para mostrar estado */
        .tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none; /* No se puede interactuar con el tooltip */
        }
        .diente:hover .tooltip {
            opacity: 1; /* Mostrar tooltip al pasar el mouse */
        }

        .numero {
            font-weight: bold; /* Resaltar el número */
            margin-top: 5px; /* Espacio entre la imagen y el número */
        }
    </style>
</head>
<body>
    <?php include_once 'layouts/nav.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1 style="text-align: center;">Odontograma del Paciente</h1>
        </section>

        <section class="content">
            <div class="odontograma">
                <!-- Dientes superiores -->
                <div class="fila">
                    <!-- Lado izquierdo (18 a 11) -->
                    <?php for ($i = 18; $i >= 11; $i--): ?>
                        <div class="diente" onclick="alert('Diente <?= $i ?> clickeado!')">
                            <img src="../img/diente/diente_<?= $i ?>.png" alt="Diente <?= $i ?>">
                            <div class="numero"><?= $i ?></div> <!-- Mostrar número del diente -->
                            <div class="tooltip">Estado: Sano</div>
                        </div>
                    <?php endfor; ?>

                    <!-- Lado derecho (21 a 28) -->
                    <?php for ($i = 21; $i <= 28; $i++): ?>
                        <div class="diente" onclick="alert('Diente <?= $i ?> clickeado!')">
                            <img src="../img/diente/diente_<?= $i ?>.png" alt="Diente <?= $i ?>">
                            <div class="numero"><?= $i ?></div> <!-- Mostrar número del diente -->
                            <div class="tooltip">Estado: Sano</div>
                        </div>
                    <?php endfor; ?>
                </div>

                <div class="central">Dientes centrales (superior)</div>

                <!-- Dientes inferiores -->
                <div class="fila">
                    <!-- Lado izquierdo (48 a 41) -->
                    <?php for ($i = 48; $i >= 41; $i--): ?>
                        <div class="diente" onclick="alert('Diente <?= $i ?> clickeado!')">
                            <img src="../img/diente/diente_<?= $i ?>.png" alt="Diente <?= $i ?>">
                            <div class="numero"><?= $i ?></div> <!-- Mostrar número del diente -->
                            <div class="tooltip">Estado: Sano</div>
                        </div>
                    <?php endfor; ?>

                    <!-- Lado derecho (31 a 38) -->
                    <?php for ($i = 31; $i <= 38; $i++): ?>
                        <div class="diente" onclick="alert('Diente <?= $i ?> clickeado!')">
                            <img src="../img/diente/diente_<?= $i ?>.png" alt="Diente <?= $i ?>">
                            <div class="numero"><?= $i ?></div> <!-- Mostrar número del diente -->
                            <div class="tooltip">Estado: Sano</div>
                        </div>
                    <?php endfor; ?>
                </div>

                <div class="central">Dientes centrales (inferior)</div>
            </div>
        </section>
    </div>

    <?php include_once 'layouts/footer.php'; ?>
</body>
</html>
