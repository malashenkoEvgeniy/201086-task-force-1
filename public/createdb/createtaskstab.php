<?php
//В поле $tasks[$i]['address'] ставит id массва $cities и в слусае отсутствия данных в $cities дозаполняет их

for ($i = 0; $i < count($tasks); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($tasks[$i]['address'] == $cities[$j]['city']){
            $tasks[$i]['address'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$tasks[$i]['address'], 'lat' =>$tasks[$i]['lat'], 'long' =>$tasks[$i]['long'] ]);     
    }
}
for ($i = 0; $i < count($tasks); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($tasks[$i]['address'] == $cities[$j]['city']){
                $tasks[$i]['address'] = $cities[$j]['id'];
          }
     }
}