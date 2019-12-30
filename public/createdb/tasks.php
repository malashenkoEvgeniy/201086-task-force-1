<?php
$result = "INSERT INTO"." `tasks`(`id`, `creation_time`, `name`, `category_id`, `description`, `location_id`, `budget`, `deadline`, `customer_id`, `status`) VALUES";

for ($i = 0; $i < count($tasks); $i++) {
        $id = $tasks[$i]['id'];
        $creation_time = $tasks[$i]['dt_add'];
        $name = $tasks[$i]['name'];
        $category_id = $tasks[$i]['category_id'];
        $description = $tasks[$i]['description'];
        $location_id = $tasks[$i]['adress'];
        $budget = $tasks[$i]['budget'];
        $deadline = $tasks[$i]['expire'];
        $customer_id = $tasks[$i]['customer_id']; 
        $status = $tasks[$i]['status'];
        $result .= "(\"$id\",\"$creation_time\",\"$name\", \"$category_id\",\"$description\",\"$location_id\",\"$budget\",\"$deadline\", \"$customer_id\", \"$status\")";
        if ($i !== (count($tasks)-1)) {
            $result .= ",";
        }
}
file_put_contents("../docs/tasks.sql", $result);