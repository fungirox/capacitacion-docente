<?php require view("components/styledHeader.php"); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Historial de Cursos</h1>

    <div>
        <h3>Cursos concluidos</h3>
        <?php foreach ($activeCouses as $course): ?>
            <div>
                <p><?= $course['CURSO_Nombre'] ?></p>
                <div class="order-1 order-md-2 d-grid col-12 col-md-auto">
                <a href="../../admin/generarReporte/F05PSA19.02" type="button" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    <span>Descargar evaluación</span>
                </a>
        </div>
            </div>
        <?php endforeach; ?>
    </div>
    
</main>
<?php require view("components/styledFooter.php"); ?>