<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/instruyendo", "title" => $title]) ?>
    <div class="d-flex align-items-center gap-4">
        <div class="d-flex gap-2">
            <a href="<?= $sesion > 1 ? "/instruyendo/curso/asistencia?id=38&sesion=" . ($sesion - 1) : "" ?>" class="btn btn-outline-<?= $sesion > 1 ? "primary" : "secondary" ?>">
                <i class="bi bi-chevron-left"></i>
            </a>
            <a href="<?= $nuevaSesion ? "" : "/instruyendo/curso/asistencia?id=38&sesion=" . ($sesion + 1) ?>" class="btn btn-outline-<?= $nuevaSesion ? "secondary" : "primary"  ?>">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
        <h2 class="h3 my-4">
            Sesión <?= $sesion . " - " . $date ?>
        </h2>
    </div>
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
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="alumnos[]"
                                    value="<?= $alumno["id"] ?>"
                                    <?= !$nuevaSesion ? "disabled" : "" ?>
                                    <?= $alumno["presente"] == 1 ? "checked" : "" ?> />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($nuevaSesion): ?>
            <div class="row row-cols-auto justify-content-end pt-2 g-2">
                <div class="order-2 order-md-1 col-12 col-md-auto d-grid">
                    <a href="/instruyendo" class="btn btn-outline-secondary">Cancelar</a>
                </div>
                <div class="order-1 order-md-2 col-12 col-md-auto d-grid">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        <?php endif; ?>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>