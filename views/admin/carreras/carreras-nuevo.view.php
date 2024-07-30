<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledHeader.php"; ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1>Carreras</h1>
    <form class="row py-4 g-3">
        <div class="col-md-8">
            <label for="inputEmail4" class="form-label">Nombre de la carrera</label>
            <input type="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Abreviación</label>
            <input type="password" class="form-control" id="inputPassword4">
            <div class="form-text" id="basic-addon4">Usualmente de 3 a 4 letras.</div>
        </div>
        <div class="col-12 col-md-auto d-grid">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </form>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/components/styledFooter.php"; ?>