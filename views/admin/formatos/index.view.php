<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <form action="/admin/formatos/tecNM" method="post">
        <h2>TecNM</h2>
        <input type="hidden" name="year" id="year" value="<?= $year ?>">
        <div class="">
            <label for="periodo" class="form-label">Periodo</label>
            <select name="periodo" id="periodo" class="" aria-label="Periodo">
                <option value="0" selected >Enero-Mayo <?= $year ?></option>
                <option value="1">Verano <?= $year ?></option>
                <option value="2">Agosto-Diciembre <?= $year ?></option>
                <option value="3">Personalizado</option>
            </select>
        </div>
        <div id="periodoPersonalizado" style="display: none;">
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" name="fechaInicio" id="fechaInicio">

            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" name="fechaFin" id="fechaFin">
        </div>
        <button type="submit">Generar Reporte</button>
    </form>
    <form action="/admin/formatos/F06PSA19.02" method="post">
        <h2>Formato itesca</h2>
        <input type="hidden" name="year" id="year" value="<?= $year ?>">
        <div class="">
            <label for="periodo" class="form-label">Periodo</label>
            <select name="periodo" id="periodo" class="" aria-label="Periodo">
                <option value="0">Enero-Mayo <?= $year ?></option>
                <option value="1">Verano <?= $year ?></option>
                <option value="2">Agosto-Diciembre <?= $year ?></option>
                <option value="3">Personalizado</option>
            </select>
        </div>
        <div id="periodoPersonalizado" style="display: none;">
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" name="fechaInicio" id="fechaInicio">

            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" name="fechaFin" id="fechaFin">
        </div>
        <button type="submit">Generar Reporte</button>
    </form>


</main>
<?php view("components/styledFooter.php"); ?>