<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <form action="/admin/formatos/tecNM" method="post">
        <h2>TecNM</h2>
        <input type="hidden" name="year" id="year" value="<?= $year ?>">
        <div class="">
            <label for="periodoTEC" class="form-label">Periodo</label>
            <select name="periodoTEC" id="periodoTEC" class="" aria-label="periodoTEC">
                <option value="0" selected >Enero-Mayo <?= $year ?></option>
                <option value="1">Verano <?= $year ?></option>
                <option value="2">Agosto-Diciembre <?= $year ?></option>
                <option value="3">Personalizado</option>
            </select>
        </div>
        <div id="periodoPersonalizadoTEC">
            <label for="fechaInicial">Fecha Inicio:</label>
            <input type="date" name="fechaInicial" id="fechaInicial">

            <label for="fechaFinal">Fecha Fin:</label>
            <input type="date" name="fechaFinal" id="fechaFinal">
        </div>
        <button type="submit">Generar Reporte</button>
    </form>
    <form action="/admin/formatos/F06PSA19.02" method="post">
        <h2>Formato itesca</h2>
        <input type="hidden" name="year" id="year" value="<?= $year ?>">
        <div class="">
            <label for="periodoITESCA" class="form-label">Periodo</label>
            <select name="periodoITESCA" id="periodoITESCA" class="" aria-label="periodoITESCA">
                <option value="0">Enero-Mayo <?= $year ?></option>
                <option value="1">Verano <?= $year ?></option>
                <option value="2">Agosto-Diciembre <?= $year ?></option>
                <option value="3">Personalizado</option>
            </select>
        </div>
        <div id="periodoPersonalizadoITESCA">
            <label for="fechaInicial">Fecha Inicio:</label>
            <input type="date" name="fechaInicial" id="fechaInicial">

            <label for="fechaFinal">Fecha Fin:</label>
            <input type="date" name="fechaFinal" id="fechaFinal">
        </div>
        <button type="submit">Generar Reporte</button>
    </form>


</main>
<?php view("components/styledFooter.php"); ?>