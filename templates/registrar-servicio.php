<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar servicio</title>
</head>

<body>
    <h1>Registrar servicio</h1>
    <form>
        <!--- Nombre del servicio --->
        <label for="curso_name">Nombre de servicio</label>
        <input type="text" id="curso_name" required placeholder="Nombre del curso" name="curso_name" />
        <br />
        <!--- Tipo de servicio: curso, taller y diplomado --->
        <label for="curso_type">Tipo de servicio</label>
        <input type="radio" id="curso" required name="curso_type" value="curso" checked="checked" />
        <label for="curso">Curso</label>

        <input type="radio" id="taller" required name="curso_type" value="taller" />
        <label for="taller">Taller</label>

        <input type="radio" id="diplomado" required name="curso_type" value="diplomado" />
        <label for="diplomado">Diplomado</label>
        <br />
        <!--- Tipo de servicio: interno, externo --->
        <input type="radio" id="interno" required name="curso_type_2" value="interno" checked="checked" />
        <label for="interno">Interno</label>

        <input type="radio" id="externo" required name="curso_type_2" value="externo" />
        <label for="externo">Externo</label>
        <br />
        <!--- Seleccionar instructor --->
        <label for="docentes">Instructores</label>
        <select name="docentes" id="docentes">
            <option value="docente_1" selected="true">José Luis Beltran Marquez</option>
            <option value="docente_2">Manuel Ramirez Lopez</option>
            <option value="docente_3">Dagoberto Ramirez Rendón</option>
        </select>
        <button>Agregar instructor</button>
        <br />
        <!-- Aquí falta lo de areas, aun no sé como hacerlo -->
        <p>Áreas</p>
        <br />
        <!-- Horario -->
        <label for="presencial">Horas presenciales</label>
        <input type="number" min="0" id="presencial" required value="0" name="presencial" />
        <label for="virtual">Horas virtuales</label>
        <input type="number" min="0" id="virtual" required value="0" name="virtual" />
        <br />

    </form>
</body>

</html>