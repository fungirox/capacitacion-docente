<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/instruyendo", "title" => $title]) ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" colspan="2">Alumno</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $key => $alumno): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($alumno["nombre"]) ?></td>
                            <td class="text-end">
                                <input type="number" class="" name="alumnos[<?= $alumno["id"] ?>]" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row row-cols-auto justify-content-end pt-2 g-2">
            <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                <a href="/instruyendo" class="btn btn-outline-secondary">Cancelar</a>
            </div>
            <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>