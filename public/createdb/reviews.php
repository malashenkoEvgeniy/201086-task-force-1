<?php
$result = "INSERT INTO"." `reviews`(`id`, `creation_time`, `executor_id`, `customer_id`, `assessment`, `task_id`, `comment`) VALUES";

for ($i = 0; $i < count($opinions); $i++) {
        $id = $opinions[$i]['id'];
        $creation_time = $opinions[$i]['dt_add'];
        $executor_id = $opinions[$i]['executor_id'];
        $customer_id = $opinions[$i]['customer_id'];  
        $assessment = $opinions[$i]['rate'];
        $task_id = $opinions[$i]['task_id'];
        $comment = $opinions[$i]['description'];    
        
        $result .= "(\"$id\",\"$creation_time\",\"$executor_id\", \"$customer_id\",\"$assessment\",\"$task_id\",\"$comment\")";
        if ($i !== (count($opinions)-1)) {
            $result .= ",";
        }
}

file_put_contents("../docs/reviews.sql", $result);
