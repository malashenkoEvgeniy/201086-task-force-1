<?php
$result = "INSERT INTO"." `locations`(`id`, `city`, `lat`, `long`) VALUES";
for ($i = 0; $i < count($cities); $i++) {
    $id = $cities[$i]['id'];
    $city = $cities[$i]['city'];
    $lat = $cities[$i]['lat'];
    $long = $cities[$i]['long'];
    $result .= "(\"$id\",\"$city\", \"$lat\", \"$long\")";
    if ($i !== (count($cities)-1)) {
        $result .= ",";
    }
}
file_put_contents("../docs/locations.sql", $result);