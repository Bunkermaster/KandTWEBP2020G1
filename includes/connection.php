<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 28/03/2018
 * Time: 14:45
 */
try {
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=kandtG1', 'kandtG1', 'kandtG1');
    $pdo->exec("SET NAMES UTF8");
} catch (PDOException $exception) {
    require "databaseDied.php";
    die($exception->getMessage());
}
