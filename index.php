<?php
include "includes/header.php";
require_once "includes/content.php";
// definition de la page par defaut
define('APP_DEFAUT_PAGE', 'teletubbies');
define('APP_PAGE_PARAM', 'p');
// est-ce que j'ai le parametre p dans l'url? (isset)
if (isset($_GET[APP_PAGE_PARAM])) {
    // si oui, affectation de p dans $currentPage
    $currentPage = $_GET[APP_PAGE_PARAM];
} else {
    // si non, affectation de la page par defaut dans $currentPage
    $currentPage = APP_DEFAUT_PAGE;
}
// est-ce que ce $currentPage pointe vers une page qui existe?
if (isset($content[$_GET[APP_PAGE_PARAM]])) {
    // si oui, j'affiche la page
    $page = &$content[$_GET[APP_PAGE_PARAM]];
} else {
    // si non, response code 404 et affichage de la page par defaut
    http_response_code(404);
    $currentPage = APP_DEFAUT_PAGE;
    $page = &$content[$currentPage];
}
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

