<?php
$result = "INSERT INTO"." `categories`(`id`, `title`, `title_en`) VALUES";
for ($i = 0; $i < count($categories); $i++) {
        $id = $categories[$i]['id'];
        $name = $categories[$i]['name'];
        $icon = $categories[$i]['icon'];
        $result .= "(\"$id\",\"$name\", \"$icon\")";
        if ($i !== (count($categories)-1)) {
            $result .= ",";
        }
}
file_put_contents("../docs/categories.sql", $result);