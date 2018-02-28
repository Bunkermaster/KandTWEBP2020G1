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
