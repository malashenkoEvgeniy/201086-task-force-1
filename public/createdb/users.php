<?php
$result = "INSERT INTO"." `users`(`id`, `creation_time`, `name`, `email`, `location_id`, `birthday`, `info`, `password`, `phone`, `skype`) VALUES";
for ($i = 0; $i < count($user); $i++) {
        $id = $user[$i]['id'];
        $creation_time = $user[$i]['dt_add'];
        $name = $user[$i]['name'];
        $email = $user[$i]['email'];
        $location_id = $user[$i]['address'];
        $birthday = $user[$i]['bd'];
        $info = $user[$i]['about'];
        $password = $user[$i]['password'];
        $phone = $user[$i]['phone'];
        $skype = $user[$i]['skype'];
        $result .= "(\"$id\",\"$creation_time\",\"$name\", \"$email\",\"$location_id\",\"$birthday\",\"$info\",\"$password\", \"$phone\", \"$skype\")";
        if ($i !== (count($profiles)-1)) {
            $result .= ",";
        }
}
file_put_contents("../docs/users.sql", $result);