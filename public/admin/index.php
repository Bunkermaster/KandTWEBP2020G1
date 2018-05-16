<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 14:29
 */
/**
 * @param GET action contains the action to perform
 * /admin/index.php?action=add > add a page
 * /admin/index.php?action=edit > edit a page
 */
require_once "../../includes/connection.php";
require_once "../../includes/functions.php";
require_once "../../includes/pageActions.php";
require_once "../../includes/pageSQL.php";


define("APP_DEFAULT_ACTION", "list");

$action = $_GET['action'] ?? $_POST['action'] ?? APP_DEFAULT_ACTION;

switch ($action) {
    case "add":
        add($pdo);
        break;

    case "show":
        show($pdo);
        break;

    case "edit":
        edit($pdo);
        break;

    case "delete":
        delete($pdo);
        break;

    case "list":
    default:
        // list the page
        index($pdo);
        break;
}
