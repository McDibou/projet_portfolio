<?php
// insertion du ocntroller pour le switch langage, déconnexion session & menu
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_header.php';

// récupération du contenus à partir de la base de donnnée.
$menu = afficheMenu($lang, $db);
$content = afficheContentTab('menu', $lang, $db);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
<header>
    <div class="m-lg-5 m-3 d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <!--Switch langages-->
            <div class="dropdown">

                <button class="btn btn-light" type="button" data-toggle="dropdown">
                    <img style="height: 2rem" src="view/img/burger.png">
                </button>

                <div class="dropdown-menu mt-3 ml-lg-n4">
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold" href="./"><?= $content[0] ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[2][0] ?>"><?= $content[2] ?></a>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[1][0] ?>"><?= $content[1] ?></a>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[3][0] ?>"><?= $content[3] ?></a>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[4][0] ?>"><?= $content[4] ?></a>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[5][0] ?>"><?= $content[5] ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 px-5 text-uppercase font-weight-bold"
                       href="?p=<?= $menu[6][0] ?>"><?= $content[6] ?></a>
                </div>

            </div>

            <!--Switch langages-->
            <form method="post">
                <?php if ($lang == 1) { ?>
                    <button class="btn btn-light m-2" style="font-size: 1.4rem; font-weight: 600" type="submit"
                            name="lang" value="2"><?= $content[7] ?></button>
                <?php } else { ?>
                    <button class="btn btn-light m-2" style="font-size: 1.4rem; font-weight: 600" type="submit"
                            name="lang" value="1"><?= $content[8] ?></button>
                <?php } ?>
            </form>
        </div>

        <div class="d-flex align-items-center">
            <!--affichage Pseudo-->


            <!--button déconnexion-->
            <?php if (!empty($_SESSION['pseudo'])) { ?>
                <div class="m-2" style="font-size: 1.4rem; font-weight: 600"><?= $_SESSION['pseudo'] ?></div>
                <button class="btn btn-light m-2" data-toggle="modal" data-target="#exampleModalCenter">
                    <img style="height: 2rem" src="view/img/disconnect.png" alt="">
                </button>
            <?php } ?>
        </div>
    </div>

</header>

<!--affiche confirmation déconnexion-->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-body text-center m-5">
                    <h3><?= $content[9] ?></h3>
                    <div class="pt-5">
                        <button class="btn btn-lg btn-outline-danger font-weight-bold" type="submit" name="disconnect"><?= $content[10] ?></button>
                        <button class="btn btn-lg btn-outline-info font-weight-bold" type="submit" name="non"><?= $content[11] ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

