<?php require view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1 class="mb-4">Registrar Curso</h1>
    <form action="../modules/addService.php" method="post" class="row g-3 my-4">
        <!--- Nombre del Curso --->
        <div class="form-group">
            <label for="service-name" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" required placeholder="Nombre del curso" id="service-name" name="service-name" />

            <label for="service-description" class="form-label mt-2">Descripción del curso</label>
            <textarea class="form-control" required placeholder="Descripción del curso" id="service-description" name="service-description"> </textarea>
        </div>
        <!--- Tipo de Curso: curso, taller y diplomado --->
        <div class="form-group">
            <label class="form-label">Tipo de servicio</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-type" id="curso" value="curso" checked="checked" />
                <label class="form-check-label" for="curso">Curso</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-type" id="taller" value="taller" />
                <label class="form-check-label" for="taller">Taller</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-type" id="diplomado" value="diplomado" />
                <label class="form-check-label" for="diplomado" class="form-label">Diplomado</label>
            </div>
        </div>
        <!--- Tipo de servicio: interno, externo --->
        <div class="form-group">
            <label class="form-label">Categoría de servicio</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-category" id="interno" value="0" checked="checked" />
                <label class="form-check-label" for="interno" class="form-label">Interno</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-category" id="externo" value="1" />
                <label class="form-check-label" for="externo" class="form-label">Externo</label>
            </div>
        </div>
        <!--- Seleccionar instructor --->
        <div class="form-group">
            <label for="teachers" class="form-label">Instructores</label>
            <select class="form-control" name="teachers" id="teachers">
                <?php foreach ($teachers as $row) : ?>
                    <?php
                    $userID = htmlspecialchars($row["USERID"], ENT_QUOTES, "UTF-8");
                    $userFirstName = htmlspecialchars($row["USER_Nombre"], ENT_QUOTES, "UTF-8");
                    $userLastName = htmlspecialchars($row["USER_Apellido"], ENT_QUOTES, "UTF-8");
                    ?>
                    <option value="<?= $userID ?>"><?= $userFirstName ?> <?= $userLastName ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="btn btn-primary mt-2">Agregar instructor</button>
        </div>
        <!--- Áreas --->
        <div class="form-group">
            <label class="form-label">Áreas</label>
            <?php foreach ($areas as $row) : ?>
                <?php
                $areaSiglas = htmlspecialchars($row['AREA_Siglas'], ENT_QUOTES, 'UTF-8');
                $areaID = htmlspecialchars($row['AREAID'], ENT_QUOTES, 'UTF-8');
                ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="areas[]" value="<?= $areaID ?>" id="<?= $areaID ?>">
                    <label class="form-check-label" for="<?= $areaID ?>"><?= $areaSiglas ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Horario -->
        <div class="form-group">
            <label for="physical-hours" class="form-label">Horas presenciales</label>
            <input type="number" class="form-control" min="0" required value="0" id="physical-hours" name="physical-hours" />
            <label for="virtual-hours" class="mt-2" class="form-label">Horas virtuales</label>
            <input type="number" class="form-control" min="0" required value="0" id="virtual-hours" name="virtual-hours" />
        </div>
        <!-- Fechas -->
        <div class="form-group">
            <label for="start-date" class="form-label">Fecha de inicio</label>
            <input type="date" class="form-control" id="start-date" name="start-date" min="<?= $formattedToday; ?>" value="<?= $formattedToday; ?>">
            <label for="finish-date" class="mt-2" class="form-label">Fecha de finalización</label>
            <input type="date" class="form-control" id="finish-date" name="finish-date" min="<?= $formattedToday; ?>" value="<?= $formattedTomorrow; ?>">
        </div>
        <!--- Aula -->
        <div class="form-group">
            <label for="classroom" class="form-label">Aula</label>
            <input type="number" class="form-control" min="0" id="classroom" name="classroom" />
        </div>
        <!--- Días de la semana -->
        <div class="form-group">
            <label for="week" class="form-label">Días de la semana</label>
            <?php foreach ($weekdays as $id => $name) : ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?= $id ?>" name="weekdays[]" value="<?= $id ?>">
                    <label class="form-check-label" for="<?= $id ?>"><?= $name ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Añadir</button>
        </div>
    </form>
</main>
<?php require view("components/styledFooter.php"); ?>