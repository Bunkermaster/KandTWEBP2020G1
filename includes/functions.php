<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 28/02/2018
 * Time: 16:54
 */

function addActive($page, $text)
{
    $activeClass = '';
    if($page === basename($_SERVER['PHP_SELF'])){
        $activeClass = ' class="active"';
    }
?>
    <li<?=$activeClass?>><a href="<?=$page?>"><?=$text?></a></li>
<?php
}

/**
 * @param array $page
 *
 * @return void
 */
function displayPage(array $page): void
{
?>
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1><?=$page['h1']?></h1>
            <p><?=$page['p']?></p>
            <span class="label <?=$page['span-class']?>"><?=$page['span-text']?></span>
        </div>
        <img class="img-thumbnail" alt="<?=$page['img-alt']?>" src="img/<?=$page['img-src']?>" data-holder-rendered="true">
    </div>
<?php
}

/**
 * @param PDO $pdo
 * @param string $slug
 *
 * @return null|array returns array if data found, null if not
 */
function getPage(PDO $pdo, string $slug): ?array
{
    $sql = "SELECT 
              `h1`, 
              `p`, 
              `span-class`, 
              `span-text`, 
              `img-alt`, 
              `img-src` 
            FROM 
              `page` 
            WHERE 
              `slug` = :slug
            LIMIT 1
            ;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':slug',$slug, PDO::PARAM_STR);
//    $stmt->execute(['slug' => $slug]);// crap version
    $stmt->execute();
    if (false === $row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        return null;
    }

    return $row;
}

/**
 *
 */
function getHeader(): void
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body role="document">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">WtfWeb</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php addActive('index.php', 'Teletubbies')?>
                <?php addActive('kittens.php', 'Chatonse')?>
                <?php addActive('ironmaiden.php', 'Iron Maidennnnn')?>
            </ul>
        </div>
    </div>
</nav>
<?php
}

/**
 *
 */
function getFooter(): void
{
?>
</body>
</html>
<?php
}