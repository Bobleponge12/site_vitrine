<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./img/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="./design/bootstrap.min.css" />
    <link rel="stylesheet" href="./design/bootstrap.min.css.map" />
    <link rel="stylesheet" href="./design/style.css" />
    <link rel="stylesheet" href="./design/styleAnimReseau.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Vitrine</title>
</head>

<body>
    <!-- HEADER -->

    <header class="p-5 text-center" style="
        background: center/cover url('img/lever_soleil_alpes_1920x1005.jpg');
      ">
        <div id="presentation" class="container">
            <p class="dwd">DWD</p>
        </div>
    </header>

    <!-- Barre de navigation -->

    <nav class="navbar sticky-top bg-dark navbar-dark navbar-expand-md">
        <!-- Le breakpoint se précise dans ce cas-->
        <div class="container">
            <div class="navbar-brand">Portail</div>

            <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#monMenuDeroulant">
                <span class="navbar-toggler-icon"></span>
            </div>

            <div class="collapse navbar-collapse" id="monMenuDeroulant">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="./vitrine.html" class="nav-link">Vitrine</a>
                    </li>
                    <li class="nav-item">
                        <a href="./siteCompteClient.php" class="nav-link">Compte client</a>
                    </li>
                    <li class="nav-item">
                        <a href="./contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- LES CARTES -->
    <section>
        <div class="container p-5">

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white p-3">
        <div class="row text-center">
            <!-- <div class="col-2"></div> -->
            <div class="col-md-4 mt-4">
                <!-- Liens Réseaux Sociaux Animés -->
                <div class="box">
                    <!-- CHECKBOX -->
                    <input type="checkbox" name="checkbox" id="checkbox" />

                    <!-- MENU -->

                    <div class="menu">
                        <a href="#">
                            <div class="menuItems">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                        </a>
                    </div>

                    <div class="menu">
                        <a href="#">
                            <div class="menuItems">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </a>
                    </div>
                    <div class="menu">
                        <a href="#">
                            <div class="menuItems">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </a>
                    </div>
                    <div class="menu">
                        <a href="#">
                            <div class="menuItems">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 dwd">DWD</div>
            <!-- Nom  et Année -->
            <div class="col-md-4 mt-5 fs-5">2022 © Karim Tareb</div>
        </div>
    </footer>

    <!-- BS avec JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Infobulle avec BS -->

    <script>
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Popover BS

        var popoverTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="popover"]')
        );
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        var popover = new bootstrap.Popover(
            document.querySelector(".example-popover"), {
                container: "body",
            }
        );
    </script>
</body>

</html>