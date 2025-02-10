<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script degf>
    $(document).ready(function() {
        // TecNM
        const tecPeriodoRadio = $('#tec-periodo-radio');
        const tecRangoRadio = $('#tec-rango-radio');
        const periodoTec = $('#periodo-tec');
        const rangoTec = $('#rango-tec');

        // ITESCA
        const itescaPeriodoRadio = $('#itesca-periodo-radio');
        const itescaRangoRadio = $('#itesca-rango-radio');
        const periodoItesca = $('#periodo-itesca');
        const rangoItesca = $('#rango-itesca');

        function toggleTec() {
            if (tecPeriodoRadio.prop('checked')) {
                periodoTec.show();
                rangoTec.hide();
            } else {
                periodoTec.hide();
                rangoTec.show();
            }
        }

        function toggleItesca() {
            if (itescaPeriodoRadio.prop('checked')) {
                periodoItesca.show();
                rangoItesca.hide();
            } else {
                periodoItesca.hide();
                rangoItesca.show();
            }
        }

        $('input[name="tec-radio"]').change(toggleTec);
        $('input[name="itesca-radio"]').change(toggleItesca);

        toggleTec();
        toggleItesca();
    });
</script>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="row row-cols-1 row-cols-lg-2 pt-4 g-4">
        <div class="col">
            <form action="/admin/formatos/tecNM" method="post" class="card rounded-4">
                <div class="card-body d-flex flex-column gap-4">
                    <h2 class="text-center">TecNM</h2>
                    <div class="btn-group">
                        <input type="radio" class="btn-check" name="tec-radio" id="tec-periodo-radio" checked>
                        <label class="btn btn-outline-primary" for="tec-periodo-radio">Periodo</label>
                        <input type="radio" class="btn-check" name="tec-radio" id="tec-rango-radio">
                        <label class="btn btn-outline-primary" for="tec-rango-radio">Rango</label>
                    </div>
                    <input type="hidden" name="year" id="year" value="<?= $year ?>">
                    <select name="periodoTEC" id="periodo-tec" class="form-select">
                        <option value="0" selected>Enero-Mayo <?= $year ?></option>
                        <option value="1">Verano <?= $year ?></option>
                        <option value="2">Agosto-Diciembre <?= $year ?></option>
                    </select>
                    <div id="rango-tec">
                        <div class="d-flex">
                            <input type="date" name="fechaInicial" id="fechaInicial" class="form-control">
                            <i class="bi bi-arrow-right align-self-center mx-2"></i>
                            <input type="date" name="fechaFinal" id="fechaFinal" class="form-control">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <form action="/admin/formatos/F06PSA19.02" method="post" class="card rounded-4">
                <div class="card-body d-flex flex-column gap-4">
                    <h2 class="text-center">ITESCA</h2>
                    <div class="btn-group">
                        <input type="radio" class="btn-check" name="itesca-radio" id="itesca-periodo-radio" checked>
                        <label class="btn btn-outline-primary" for="itesca-periodo-radio">Periodo</label>
                        <input type="radio" class="btn-check" name="itesca-radio" id="itesca-rango-radio">
                        <label class="btn btn-outline-primary" for="itesca-rango-radio">Rango</label>
                    </div>
                    <input type="hidden" name="year" id="year" value="<?= $year ?>">
                    <select name="periodoTEC" id="periodo-itesca" class="form-select">
                        <option value="0">Enero-Mayo <?= $year ?></option>
                        <option value="1">Verano <?= $year ?></option>
                        <option value="2">Agosto-Diciembre <?= $year ?></option>
                    </select>
                    <div id="rango-itesca">
                        <div class="d-flex">
                            <input type="date" name="fechaInicial" id="fechaInicial" class="form-control">
                            <i class="bi bi-arrow-right align-self-center mx-2"></i>
                            <input type="date" name="fechaFinal" id="fechaFinal" class="form-control">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>