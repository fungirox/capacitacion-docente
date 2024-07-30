<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledHeader.php"; ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Carreras</h1>
    <form class="row py-4 g-3" method="POST">
        <div class="col-md-8">
            <label for="nombre" class="form-label">Nombre de la carrera</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-4">
            <label for="siglas" class="form-label">Siglas</label>
            <input type="text" class="form-control" id="siglas" name="siglas" required>
            <div class="form-text" id="basic-addon4">Usualmente de 3 a 4 letras.</div>
        </div>
        <div class="col-12 col-md-auto d-grid">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </form>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledFooter.php"; ?>