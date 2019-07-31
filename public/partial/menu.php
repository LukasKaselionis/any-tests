<?php

declare(strict_types = 1);

use AnyTests\Models\Category;

$categoryModel = new Category();

$categories = $categoryModel->get();

?>

<ul>
    <li style="display: inline"><a href="../public">Home</a></li>
    <?php
    foreach ($categories as $category)
    {
        ?>
        <li style="display: inline" ><a href="../public?category=<?= $category['slug'] ?>"><?= $category['title'] ?></a></li>
        <?php
    }
    ?>
</ul>
