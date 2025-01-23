<?php view("components/styledHeader.php", ["title" => $title]); ?>
<script>
    $(document).ready(() => {
        const $dropdown = $('#instructorDropdown');
        const $search = $('#instructor-search');
        const $hiddenInput = $('#instructor-selected');
        const $dropdownItems = $('.dropdown-item');

        const previousInstructorId = '<?= cleanOld("instructor") ?>';
        if (previousInstructorId) {
            const $selectedItem = $(`.dropdown-item[data-value="${previousInstructorId}"]`);
            if ($selectedItem.length) {
                $dropdown.text($selectedItem.text());
                $hiddenInput.val(previousInstructorId);
            }
        }

        $search.on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $dropdownItems.each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });

        $dropdownItems.on('click', function() {
            const instructorName = $(this).text();
            const instructorId = $(this).data('value');

            $dropdown.text(instructorName);

            $hiddenInput.val(instructorId);

            $dropdown.dropdown('toggle');
        });

        const modalidadPresencial = $('#modalidad-presencial');
        const modalidadMixto = $('#modalidad-mixto');
        const modalidadVirtual = $('#modalidad-virtual');

        const horesPresencialesContainer = $('#horas-presenciales-container');
        const aulaContainer = $('#aula-container');
        const diasLabel = $('#dias-label-container');
        const diasContainer = $('#dias-container');
        const horaInicialContainer = $('#hora-inicial-container');
        const horaFlecha = $('#hora-flecha');
        const horaFinalContainer = $('#hora-final-container');
        const limiteContainer = $('#limite-container');

        const toggleInputs = () => {
            if (modalidadVirtual.prop('checked')) {
                aulaContainer.hide();
                diasLabel.hide();
                diasContainer.hide();
                horaInicialContainer.hide();
                horaFlecha.hide();
                horaFinalContainer.hide();
                limiteContainer.hide();
            } else {
                aulaContainer.show();
                diasLabel.show();
                diasContainer.show();
                horaInicialContainer.show();
                horaFlecha.show();
                horaFinalContainer.show();
                limiteContainer.show();
            }
            if (modalidadMixto.prop('checked')) {
                horesPresencialesContainer.show()
            } else {
                horesPresencialesContainer.hide();
            }
        }

        $('input[name="modalidad"]').on('change', () => {
            toggleInputs();
        });

        toggleInputs();
    });
</script>
<main role="main" class="container pt-5" style="margin-top: 56px">
    <?php view("components/nestedTitle.php", ["url" => "/admin/cursos", "title" => $title]) ?>
    <form class="row py-4" method="POST" action="/admin/cursos">
        <h2 class="mb-4">Información Básica</h2>
        <div class="d-flex justify-content-center mb-3">
            <div class="col-12 col-md-8 col-lg-6 btn-group" name="tipo" role="group">
                <input type="radio" class="btn-check" name="tipo" id="tipo-curso" value="curso" autocomplete="off" <?= cleanOld("tipo", "curso") === "curso" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="tipo-curso">Curso</label>
                <input type="radio" class="btn-check" name="tipo" id="tipo-taller" value="taller" autocomplete="off" <?= cleanOld("tipo") === "taller" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="tipo-taller">Taller</label>
                <input type="radio" class="btn-check" name="tipo" id="tipo-diplomado" value="diplomado" autocomplete="off" <?= cleanOld("tipo") === "diplomado" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="tipo-diplomado">Diplomado</label>
            </div>
        </div>
        <?php if (isset($errors['tipo'])): ?>
            <small class="text-danger-emphasis mb-3"><?= $errors['tipo'] ?></small>
        <?php endif; ?>
        <div class="col-12 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control <?= isValidInput($errors, "nombre") ?>" id="nombre" name="nombre" value="<?= cleanOld("nombre") ?>">
            <div class="invalid-feedback">
                <?= $errors['nombre'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control <?= isValidInput($errors, "descripcion") ?>" rows="3" id="descripcion" name="descripcion"><?= cleanOld("descripcion") ?></textarea>
            <div class="invalid-feedback">
                <?= $errors['descripcion'] ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="dropdown">
                <label for="descripcion" class="form-label">Instructor</label>
                <button class="form-select text-start <?= isValidInput($errors, "instructor") ?>" id="instructorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Seleccionar Instructor...
                </button>
                <div class="invalid-feedback">
                    <?= $errors['instructor'] ?>
                </div>
                <div class="dropdown-menu w-100 shadow" aria-labelledby="instructorDropdown">
                    <div class="px-2">
                        <input type="text" class="form-control" id="instructor-search" placeholder="Buscar instructor...">
                    </div>
                    <div class="instructor-list pt-2">
                        <?php foreach ($instructores as $instructor): ?>
                            <button class="dropdown-item" type="button" data-value="<?= $instructor["id"] ?>">
                                <?= $instructor["nombre"] ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <input type="hidden" id="instructor-selected" name="instructor" />
            </div>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Áreas</label>
            <?php foreach ($areas as $area): ?>
                <div class="form-check">
                    <input class="form-check-input" <?= in_array($area["id"], old("areas", [])) ? "checked" : "" ?> type="checkbox" id="area-<?= $area["id"] ?>" name="areas[]" value="<?= $area["id"] ?>">
                    <label class="form-check-label" for="area-<?= $area["id"] ?>">
                        <?= $area["nombre"] ?>
                    </label>
                </div>
            <?php endforeach; ?>
            <?php if (isset($errors['areas'])): ?>
                <small class="text-danger-emphasis mb-3"><?= $errors['areas'] ?></small>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <label for="perfil" class="form-label">Tipo de perfil</label>
            <select name="perfil" id="perfil" class="form-select <?= isValidInput($errors, "perfil") ?>" aria-label="Perfil">
                <option value="0" <?= cleanOld("perfil", "0") === "0" ? "selected" : "" ?>>Actualización profesional</option>
                <option value="1" <?= cleanOld("perfil") === "1" ? "selected" : "" ?>>Formación docente</option>
            </select>
            <div class="invalid-feedback">
                <?= $errors['perfil'] ?>
            </div>
        </div>
        <h2 class="mt-4 mb-3">Horario</h2>
        <div class="col-12 d-flex justify-content-center mb-3">
            <div class="col-12 col-md-8 col-lg-6 btn-group" name="modalidad" role="group">
                <input type="radio" class="btn-check" name="modalidad" id="modalidad-presencial" value="presencial" autocomplete="off" <?= cleanOld("modalidad", "presencial") === "presencial" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="modalidad-presencial">Presencial</label>
                <input type="radio" class="btn-check" name="modalidad" id="modalidad-mixto" value="mixto" autocomplete="off" <?= cleanOld("modalidad") === "mixto" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="modalidad-mixto">Mixto</label>
                <input type="radio" class="btn-check" name="modalidad" id="modalidad-virtual" value="virtual" autocomplete="off" <?= cleanOld("modalidad") === "virtual" ? "checked" : "" ?>>
                <label class="btn btn-outline-primary" for="modalidad-virtual">Virtual</label>
            </div>
        </div>
        <?php if (isset($errors['modalidad'])): ?>
            <small class="text-danger-emphasis mb-3"><?= $errors['modalidad'] ?></small>
        <?php endif; ?>
        <div class="w-100"></div>
        <div class="col mb-3">
            <label for="fecha-inicial" class="form-label">Fecha inicial</label>
            <input type="date" class="form-control <?= isValidInput($errors, "fechaInicial") ?>" id="fecha-inicial" name="fecha-inicial" value="<?= cleanOld("fechaInicial") ?>">
            <div class="invalid-feedback">
                <?= $errors['fechaInicial'] ?>
            </div>
        </div>
        <div class="col-auto mb-3 d-flex align-items-end pb-2">
            <i class="bi bi-arrow-right"></i>
        </div>
        <div class="col mb-3">
            <label for="fecha-final" class="form-label">Fecha final</label>
            <input type="date" class="form-control <?= isValidInput($errors, "fechaFinal") ?>" id="fecha-final" name="fecha-final" value="<?= cleanOld("fechaFinal") ?>">
            <div class="invalid-feedback">
                <?= $errors['fechaFinal'] ?>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col mb-3">
            <label for="horas-total" class="form-label">Horas en total</label>
            <input type="number" class="form-control <?= isValidInput($errors, "horasTotal") ?>" id="horas-total" name="horas-total" value="<?= cleanOld("horasTotal") ?>">
            <div class="invalid-feedback">
                <?= $errors['horasTotal'] ?>
            </div>
        </div>
        <div id="horas-presenciales-container" class="col mb-3">
            <label for="horas-presenciales" class="form-label">Horas presenciales</label>
            <input type="number" class="form-control <?= isValidInput($errors, "horasPresenciales") ?>" id="horas-presenciales" name="horas-presenciales" value="<?= cleanOld("horasPresenciales") ?>">
            <div class="invalid-feedback">
                <?= $errors['horasPresenciales'] ?>
            </div>
        </div>
        <div id="aula-container" class="col-12 mb-3">
            <label for="aula" class="form-label">Aula</label>
            <input type="text" class="form-control <?= isValidInput($errors, "aula") ?>" id="aula" name="aula" value="<?= cleanOld("aula") ?>">
            <div class="invalid-feedback">
                <?= $errors['aula'] ?>
            </div>
        </div>
        <label id="dias-label-container" class="form-label">Días</label>
        <div id="dias-container" class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group" id="dias">
            <?php foreach ($days as $day => $dayName): ?>
                <input type="checkbox" class="btn-check" <?= in_array($day, old("dias", [])) ? "checked" : "" ?> id="<?= $day ?>" name="dias[]" value="<?= $day ?>" autocomplete="off">
                <label class="btn btn-outline-secondary" for="<?= $day ?>">
                    <span class="d-block d-md-none"><?= strtoupper(substr($dayName, 0, 2)) ?></span>
                    <span class="d-none d-md-block"><?= $dayName ?></span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php if (isset($errors['dias'])): ?>
            <small class="text-danger-emphasis mb-3"><?= $errors['dias'] ?></small>
        <?php endif; ?>
        <div class="w-100"></div>
        <div id="hora-inicial-container" class="col mb-3">
            <label for="hora-inicial" class="form-label">Hora inicial</label>
            <input type="time" class="form-control <?= isValidInput($errors, "horaInicial") ?>" id="hora-inicial" name="hora-inicial" value="<?= cleanOld("horaInicial") ?>">
            <div class="invalid-feedback">
                <?= $errors['horaInicial'] ?>
            </div>
        </div>
        <div id="hora-flecha" class="col-auto row pb-2 mb-3 align-items-end">
            <i class="col bi bi-arrow-right"></i>
        </div>
        <div id="hora-final-container" class="col mb-3">
            <label for="hora-final" class="form-label">Hora final</label>
            <input type="time" class="form-control <?= isValidInput($errors, "horaFinal") ?>" id="hora-final" name="hora-final" value="<?= cleanOld("horaFinal") ?>">
            <div class="invalid-feedback">
                <?= $errors['horaFinal'] ?>
            </div>
        </div>
        <div class="w-100"></div>
        <div id="limite-container" class="col-12 mb-3">
            <label for="limite" class="form-label">Límite de estudiantes</label>
            <input type="number" class="form-control <?= isValidInput($errors, "limite") ?>" id="limite" name="limite" value="<?= cleanOld("limite") ?>">
            <div class="invalid-feedback">
                <?= $errors['limite'] ?>
            </div>
        </div>
        <div id="externo-switch">
            <div class="form-check mb-2">
                <label class="form-check-label" for="externo">El servicio es externo</label>
                <input class="form-check-input <?= isValidInput($errors, "externo") ?>" type="checkbox" role="switch" name="externo" id="externo" value="1" <?= cleanOld("externo", "0") === "1" ? "checked" : "" ?>>
                <div class="invalid-feedback">
                    <?= $errors['externo'] ?>
                </div>
            </div>
        </div>
        <div class="order-2 order-md-1 col-md-auto col-12 ms-md-auto mb-3">
            <div class="d-grid"><a href="/admin/cursos" class="btn btn-outline-secondary">Cancelar</a></div>
        </div>
        <div class="order-1 order-md-2 col-md-auto col-12 mb-3">
            <div class="d-grid"><button type="submit" class="btn btn-primary">Agregar</button></div>
        </div>
    </form>
</main>
<?php view("components/styledFooter.php"); ?>