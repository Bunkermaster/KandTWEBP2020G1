<?php
include "includes/header.php";
require_once "includes/content.php";
// definition de la page par defaut
// est-ce que j'ai le parametre p dans l'url? (isset)
    // si oui, affectation de p dans $currentPage
    // si non, j'affiche la page par defaut
// est-ce que ce $currentPage pointe vers une page qui existe?
    // si oui, j'affiche la page
    // si non, response code 404 et affichage de la page par defaut
$page = $content[$_GET['p'] ?? 'teletubbies'];
?>
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1><?=$page['h1']?></h1>
            <p><?=$page['p']?></p>
            <span class="label <?=$page['span-class']?>"><?=$page['span-text']?></span>
        </div>
        <img class="img-thumbnail" alt="<?=$page['img-alt']?>" src="img/<?=$page['img-src']?>" data-holder-rendered="true">
    </div>
<?php include "includes/footer.php"?>

