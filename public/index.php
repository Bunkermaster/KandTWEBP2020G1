<?php
define('APP_ROOT_DIR', dirname(__DIR__)."/");
require_once APP_ROOT_DIR."includes/connection.php";
require_once APP_ROOT_DIR."includes/functions.php";
// definition de la page par defaut
define('APP_DEFAUT_PAGE', 'teletubbies');
define('APP_PAGE_PARAM', 'p');
define('APP_URL_STRUCT', 'index.php?');
// est-ce que j'ai le parametre p dans l'url? (isset)
$currentPage = $_GET[APP_PAGE_PARAM] ?? APP_DEFAUT_PAGE;
try {
    $page = getPage($pdo, $currentPage);
// est-ce que ce $currentPage pointe vers une page qui existe?
    if (is_null($page)) {
        // si non, response code 404 et affichage de la page par defaut
        http_response_code(404);
        $currentPage = APP_DEFAUT_PAGE;
        $page = getPage($pdo, $currentPage);
    }
    getHeader($pdo, $currentPage);
    displayPage($page);
    getFooter();
} catch(PDOException $PDOException) {
    die($PDOException->getMessage());
} catch(Exception $exception) {
    die($exception->getMessage());
}
