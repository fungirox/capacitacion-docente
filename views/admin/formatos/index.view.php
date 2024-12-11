<?php view("components/styledHeader.php", ["title" => $title]); ?>
<main role="main" class="container py-4" style="margin-top: 56px">
    <h1><?= $title ?></h1>
    <div class="">
        <a href="/admin/formatos/tecNM">FD_AP_2022 Formato TecNM</a>
        <a href="/admin/formatos/F06PSA19.02">Formato ITESCA</a>
    </div>
</main>
<?php view("components/styledFooter.php"); ?>