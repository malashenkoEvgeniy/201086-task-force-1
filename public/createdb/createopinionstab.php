<?php
for ($i = 0; $i < count($opinions); $i++){
    $opinions[$i]['executor_id'] = mt_rand(0, array_pop($user)['id']);
    $rand = mt_rand(0, array_pop($user)['id']);
    while ($opinions[$i]['executor_id'] == $rand) {
        $rand = mt_rand(0, array_pop($user)['id']);
    }
    $opinions[$i]['customer_id'] = $rand;
    $opinions[$i]['task_id'] = mt_rand(0, array_pop($tasks)['id']);
}