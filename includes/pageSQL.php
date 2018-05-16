<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 14:42
 */

function sqlAdd(PDO $pdo, $data)
{
    $sql = "INSERT INTO `page`(
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
) VALUES (
  :slug,
  :title,
  :h1,
  :p,
  :spanclass,
  :spantext,
  :imgalt,
  :imgsrc,
  :navtitle
)
;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":slug", htmlspecialchars($data['slug']));
    $stmt->bindValue(":title", htmlspecialchars($data['title']));
    $stmt->bindValue(":h1", htmlspecialchars($data['h1']));
    $stmt->bindValue(":p", htmlspecialchars($data['p']));
    $stmt->bindValue(":spanclass", htmlspecialchars($data['span-class']));
    $stmt->bindValue(":spantext", htmlspecialchars($data['span-text']));
    $stmt->bindValue(":imgalt", htmlspecialchars($data['img-alt']));
    $stmt->bindValue(":imgsrc", htmlspecialchars($data['img-src']));
    $stmt->bindValue(":navtitle", htmlspecialchars($data['nav-title']));
    $stmt->execute();
    errorHandler($stmt);

    return $pdo->lastInsertId();
}

function sqlDelete(PDO $pdo, int $id): void
{
    $sql = "DELETE FROM `page` WHERE `id` = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    errorHandler($stmt);
}

function sqlIndex(PDO $pdo)
{
    $sql = "SELECT 
  `id`, 
  `slug` 
FROM 
  `page`
;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    errorHandler($stmt);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function sqlEdit(PDO $pdo, array $data): void
{
    $sql = "UPDATE
  `page`
SET
  `slug` = :slug,
  `title` = :title,
  `h1` = :h1,
  `p` = :p,
  `span-class` = :spanclass,
  `span-text` = :spantext,
  `img-alt` = :imgalt,
  `img-src` = :imgsrc,
  `nav-title` = :navtitle
WHERE
  `id` = :id
;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", htmlspecialchars($data['id']), PDO::PARAM_INT);
    $stmt->bindValue(":slug", htmlspecialchars($data['slug']));
    $stmt->bindValue(":title", htmlspecialchars($data['title']));
    $stmt->bindValue(":h1", htmlspecialchars($data['h1']));
    $stmt->bindValue(":p", htmlspecialchars($data['p']));
    $stmt->bindValue(":spanclass", htmlspecialchars($data['span-class']));
    $stmt->bindValue(":spantext", htmlspecialchars($data['span-text']));
    $stmt->bindValue(":imgalt", htmlspecialchars($data['img-alt']));
    $stmt->bindValue(":imgsrc", htmlspecialchars($data['img-src']));
    $stmt->bindValue(":navtitle", htmlspecialchars($data['nav-title']));
    $stmt->execute();
    errorHandler($stmt);
}

function sqlShow(PDO $pdo, int $id)
{
    $sql = "SELECT 
  `id`, 
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
FROM 
  `page`
WHERE
  id = :id
;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    errorHandler($stmt);

    return $stmt->fetch(PDO::FETCH_ASSOC);

}

