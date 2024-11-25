<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "$title - Capacitación Docente ITESCA" ?></title>
    <link rel="icon" href="../../assets/images/icono-itesca.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeDropdownItems = document.querySelectorAll('.dropdown-item[data-theme]');
            const themeIcon = document.querySelector('.theme-icon'); // Icon in the button

            const applyTheme = (theme) => {
                let activeTheme;
                if (theme === 'auto') {
                    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    activeTheme = prefersDark ? 'dark' : 'light';
                    document.documentElement.setAttribute("data-bs-theme", activeTheme);
                } else {
                    activeTheme = theme;
                    document.documentElement.setAttribute("data-bs-theme", theme);
                }
                localStorage.setItem('theme', theme);
                updateIcon(activeTheme);
            };

            const updateIcon = (theme) => {
                if (theme === 'dark') {
                    themeIcon.className = 'bi bi-moon theme-icon'; // Set to moon icon
                } else if (theme === 'light') {
                    themeIcon.className = 'bi bi-brightness-high theme-icon'; // Set to sun icon
                } else {
                    themeIcon.className = 'bi bi-circle-half theme-icon'; // Set to half-circle icon
                }
            };

            // Load saved theme or default to 'auto'
            const savedTheme = localStorage.getItem('theme') || 'auto';
            applyTheme(savedTheme);

            // Attach click event listeners to dropdown items
            themeDropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const selectedTheme = item.getAttribute('data-theme');
                    applyTheme(selectedTheme);
                });
            });
        });
    </script>

</head>

<body>