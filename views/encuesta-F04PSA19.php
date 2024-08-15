<?php
require_once '../config/connection.php';
require_once "../config/config.php";
# Esta query no es la definitiva es temporal mientras hacemos un login con todos los users y roles
$teachersQuery = "SELECT u.USERID, u.USER_Nombre, u.USER_Apellido FROM tblUsuario u JOIN tblUsuarioRoles ur ON u.USERID = ur.USERID JOIN tblRol r ON ur.ROLID = r.ROLID WHERE r.ROL_Nombre = 'Docente'";

# Aquí necesitamos el id del curso que elegimos desde la interfaz de "historial" por ahora dejaré cursoid = 1
$questionsQuery = "SELECT * FROM tblPregunta where ENCUESTAID = '1';";

$stnt = $connection->prepare($teachersQuery);
$stnt->execute();
$teachersData = $stnt->fetchAll();

$stnt = $connection->prepare($questionsQuery);
$stnt->execute();
$questions = $stnt->fetchAll();

$curso_name = "Taller de construcción para principantes en Fortnite: Battle Royale";
$instructor_name = "José Diego Rascón Amador";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F04PSA19.02</title>
</head>

<body>
    <div>
        <p>F04PSA19.02</p>
        <h3>Evaluar servicio</h3>
        <h1><?php echo $curso_name ?></h1>
        <p>Por <?php echo $instructor_name ?></p>
    </div>
    <p>Por favor, responda el siguiente cuestionario de la manera más objetiva. Seleccione un número del 1 al 5 considerando que: 1 es muy malo y 5 excelente, elija el que mejor describa su percepción del evento.</p>
    <form action="../modules/F04PSA19.php" method="post">
        <!--- Seleccionar docente al que se le registra dicha respuesta, esto es temporal mientras hay un login --->
        <label for="teachers">Docente</label>
        <select name="teachers" id="teachers">
            <?php foreach ($teachersData as $row) : ?>
                <?php
                    $userID = htmlspecialchars($row['USERID'], ENT_QUOTES, 'UTF-8');
                    $userFirstName = htmlspecialchars($row['USER_Nombre'], ENT_QUOTES, 'UTF-8');
                    $userLastName = htmlspecialchars($row['USER_Apellido'], ENT_QUOTES, 'UTF-8');
                ?>
                <option value="<?= $userID ?>"><?= $userFirstName ?> <?= $userLastName ?></option>
            <?php endforeach; ?>
        </select>
        <div>
            <?php foreach ($questions as $row): ?>
                <div>
                    <?php 
                        $questionID = htmlspecialchars($row['PREGUNTAID'], ENT_QUOTES, 'UTF-8');
                        $questionText = htmlspecialchars($row['PREGUNTA_Texto'], ENT_QUOTES, 'UTF-8');
                        $options = range(1,5);
                    ?>
                    <label for="<?= $questionID ?>"><?= $questionText ?></label>
                    <div>
                        <?php foreach ($options as $op): ?>
                            <label for="<?= $op ?>-<?= $questionID ?>"><?= $op ?></label>
                            <input type="radio" required name="<?= $questionID ?>" id="<?= $op ?>-<?= $questionID ?>" value="<?= $op ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Queda pendiente el comentarios (textarea) -->
        <!-- Queda pendiente frontend y separar por categorias las preguntas :D -->                            
        <button type="submit">Evaluar</button>
    </form>
</body>

</html>