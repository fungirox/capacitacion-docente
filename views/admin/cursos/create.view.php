<?php require view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">

    <h1 class="mb-4">Registrar Curso</h1>
    <form action="/admin/cursos" method="POST" class="row g-3 my-4">
        <!--- Nombre del Curso --->
        <div class="form-group">
            <label for="service-name" class="form-label fw-bold">Nombre del Curso</label>
            <input type="text" class="form-control" required placeholder="Nombre del curso" id="service-name" name="service-name" />

            <label for="service-description" class="form-label mt-2 fw-bold">Descripción del curso</label>
            <textarea class="form-control" required placeholder="Descripción del curso" id="service-description" name="service-description"> </textarea>
        </div>
        <!--- Tipo de Curso: curso, taller y diplomado --->
        <div class="form-group">
            <label class="form-label fw-bold">Tipo de servicio</label>
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
            <label class="form-label fw-bold">Categoría de servicio</label>
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
            <label for="teachers" class="form-label fw-bold">Instructores</label>
            <select class="form-control" name="teachers" id="teachers">
                <?php foreach ($teachers as $row) : ?>
                    <?php
                    $instructorID = htmlspecialchars($row["INSTRUCTORID"], ENT_QUOTES, "UTF-8");
                    $userID = htmlspecialchars($row["USERID"], ENT_QUOTES, "UTF-8");
                    $userFirstName = htmlspecialchars($row["USER_Nombre"], ENT_QUOTES, "UTF-8");
                    $userLastName = htmlspecialchars($row["USER_Apellido"], ENT_QUOTES, "UTF-8");
                    ?>
                    <option value="<?= $instructorID ?>"><?= $userFirstName ?> <?= $userLastName ?></option>
                <?php endforeach; ?>
            </select>
            <div class="text-end">
                <button type="button" class="btn btn-link mt-2">Registrar instructor</button>
            </div>
        </div>
        <!--- Áreas --->
        <div class="form-group">
            <label class="form-label fw-bold">Áreas</label>
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
            <label for="physical-hours" class="form-label fw-bold">Horas presenciales</label>
            <input type="number" class="form-control" min="0" required value="" id="physical-hours" name="physical-hours" />
            <label for="virtual-hours" class="form-label fw-bold mt-2"">Horas virtuales</label>
            <input type=" number" class="form-control" min="0" required value="" id="virtual-hours" name="virtual-hours" />
        </div>
        <!-- Fechas -->
        <div class="form-group">
            <label for="start-date" class="form-label fw-bold">Fecha de inicio</label>
            <input type="date" class="form-control" id="start-date" name="start-date" min="<?= $formattedToday; ?>" value="<?= $formattedToday; ?>">
            <label for="finish-date" class="mt-2  fw-bold" class="form-label">Fecha de finalización</label>
            <input type="date" class="form-control" id="finish-date" name="finish-date" min="<?= $formattedToday; ?>" value="<?= $formattedTomorrow; ?>">
        </div>
        <!--- Aula -->
        <div class="form-group">
            <label for="classroom" class="form-label fw-bold">Aula</label>
            <input type="number" class="form-control" min="0" id="classroom" name="classroom" />
        </div>

        <!--- Modalidad de servicio: presencial, virtual --->
        <div class="form-group">
            <label class="form-label fw-bold">Modalidad</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-category" id="presencial" value="0" checked="checked" />
                <label class="form-check-label" for="presencial" class="form-label">Presencial</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" required name="service-category" id="virtual" value="1" />
                <label class="form-check-label" for="virtual" class="form-label">Virtual</label>
            </div>
        </div>
        <!--- Días de la semana -->
        <div class="form-group">
            <label for="week" class="form-label fw-bold">Días de la semana</label>
            <?php foreach ($weekdays as $id => $name) : ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?= $id ?>" name="weekdays[]" value="<?= $id ?>">
                    <label class="form-check-label" for="<?= $id ?>"><?= $name ?></label>
                </div>
            <?php endforeach; ?>

            <div>Hora inicio: </div>
            <div>Hora final: </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Añadir</button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#teachers').select2({
                placeholder: "Selecciona un instructor",
                allowClear: true
            });
        });
    </script>
</main>
<?php require view("components/styledFooter.php"); ?>