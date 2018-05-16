<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 14:39
 */

function add(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Haaaaan you shouldn't be here");
    }
    if(!isset($_POST['page'])){
        throw new Exception("Gimme gimme gimme you data");
    }
    $data = $_POST['page'];
    $id = sqlAdd($pdo, $data);
    header('Location: index.php?action=show&id='.$id);
    exit;
}

/**
 * @param PDO $pdo
 */
function delete(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        sqlDelete($pdo, checkIdPost());
        header('Location: index.php');
        exit;
    }
    $id = checkIdGet();
    $data = sqlShow($pdo, $id);
    adminHeader();
    displayHomeLink();
    ?>
    <h1>Do you reallllyyyyy wish to delete <u><?=$data['slug']?></u></h1>
    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <input type="hidden" name="page[id]" value="<?=$id?>">
        <input type="submit" value="Delete">
        <input type="button" value="Cancel" onclick="history.back()">
    </form>
    <?php
    adminFooter();
}

/**
 * @param PDO $pdo
 */
function edit(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!isset($_POST['page'])){
            throw new Exception("Gimme gimme gimme you data");
        }
        sqlEdit($pdo, $_POST['page']);
        header('Location: index.php');
        exit;
    }
    $id = checkIdGet();
    adminHeader();
    displayHomeLink();
    $data = sqlShow($pdo, $id);
?>
    <form action="index.php?action=edit" method="post">
        <input type="hidden" name="page[id]" value="<?=$id?>">
        <label>slug</label><br><input type="text" name="page[slug]" value="<?=$data['slug']?>" /><br>
        <label>title</label><br><input type="text" name="page[title]" value="<?=$data['title']?>" /><br>
        <label>h1</label><br><input type="text" name="page[h1]" value="<?=$data['h1']?>" /><br>
        <label>p</label><br><textarea name="page[p]" id="" cols="30" rows="10"><?=$data['p']?></textarea><br>
        <label>span-class</label><br><input type="text" name="page[span-class]" value="<?=$data['span-class']?>" /><br>
        <label>span-text</label><br><input type="text" name="page[span-text]" value="<?=$data['span-text']?>" /><br>
        <label>img-alt</label><br><input type="text" name="page[img-alt]" value="<?=$data['img-alt']?>" /><br>
        <label>img-src</label><br><input type="text" name="page[img-src]" value="<?=$data['img-src']?>" /><br>
        <label>nav-title</label><br><input type="text" name="page[nav-title]" value="<?=$data['nav-title']?>" /><br>
        <input type="submit" value="Modifier">
    </form>
<?php
    adminFooter();
}

/**
 * @param PDO $pdo
 * @throws Exception
 */
function show(PDO $pdo)
{
    $row = sqlShow($pdo, checkIdGet());
    adminHeader();
    displayHomeLink();
?>
    <h1><?=$row['title']?></h1>
    <a href="index.php?action=edit&id=<?=$row['id']?>">Edit</a>
    <a href="index.php?action=delete&id=<?=$row['id']?>">Delete</a>
    <h2>id</h2>
    <p><?=$row['id']?></p>
    <h2>slug</h2>
    <p><?=$row['slug']?></p>
    <h2>h1</h2>
    <p><?=$row['h1']?></p>
    <h2>p</h2>
    <p><?=nl2br($row['p'])?></p>
    <h2>span-class</h2>
    <p><?=$row['span-class']?></p>
    <h2>span-text</h2>
    <p><?=$row['span-text']?></p>
    <h2>img-alt</h2>
    <p><?=$row['img-alt']?></p>
    <h2>img-src</h2>
    <p><?=$row['img-src']?></p>
    <h2>nav-title</h2>
    <p><?=$row['nav-title']?></p>
<?php
    adminFooter();
}

/**
 * @param PDO $pdo
 */
function index(PDO $pdo)
{
    $data = sqlIndex($pdo);
    adminHeader();
?>
    <table>
        <tr>
            <th>id</th>
            <th>slug</th>
            <th>action</th>
        </tr>
        <?php foreach($data as $onePage):?>
        <tr>
            <td><a href="index.php?action=show&id=<?=$onePage['id']?>"><?=$onePage['id']?></a></td>
            <td><?=$onePage['slug']?></td>
            <td>
                <a href="index.php?action=edit&id=<?=$onePage['id']?>">Edit</a>
                <a href="index.php?action=delete&id=<?=$onePage['id']?>">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <form action="index.php?action=add" method="post">
        <label>slug</label><br><input type="text" name="page[slug]" value="" /><br>
        <label>title</label><br><input type="text" name="page[title]" value="" /><br>
        <label>h1</label><br><input type="text" name="page[h1]" value="" /><br>
        <label>p</label><br><textarea name="page[p]" id="" cols="30" rows="10"></textarea><br>
        <label>span-class</label><br><input type="text" name="page[span-class]" value="" /><br>
        <label>span-text</label><br><input type="text" name="page[span-text]" value="" /><br>
        <label>img-alt</label><br><input type="text" name="page[img-alt]" value="" /><br>
        <label>img-src</label><br><input type="text" name="page[img-src]" value="" /><br>
        <label>nav-title</label><br><input type="text" name="page[nav-title]" value="" /><br>
        <input type="submit" value="Ajouter">
    </form>
<?php
    adminFooter();
}

/**
 * checks if id is specified in url
 * @throws Exception
 */
function checkIdGet(): int
{
    if(!isset($_GET['id'])){
        throw new Exception("Pleaaaaase gimme id for baby");
    }

    return (int) $_GET['id'];
}

function checkIdPost(): int
{
    if(!isset($_POST['page']['id'])){
        throw new Exception("Pleaaaaase gimme id for baby");
    }

    return (int) $_POST['page']['id'];
}

function displayHomeLink()
{
    ?>
    <a href="index.php">&lt; Home!</a>
    <?php
}

