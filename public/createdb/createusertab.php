<?php
//Соеденяет массив $profiles и $users
  for ($i = 0; $i < count($profiles); $i++) {
      if($profiles[$i]['id']==$users[$i]['id']){
          $user[$i] = array_merge($profiles[$i], $users[$i]);
      }
      if($users[$i]['id']==null){
          $user[$i] = $profiles[$i];
      }
  }
//В поле $user[$i]['address'] ставит id массва $cities и в слусае отсутствия данных в $cities дозаполняет их
for ($i = 0; $i < count($user); $i++) {
    $flag = 0;
    for ($j = 0; $j < count($cities); $j++) {
        if($user[$i]['address'] == $cities[$j]['city']){
            $user[$i]['address'] = $cities[$j]['id'];
            $flag = 1;
        }
    }
    if($flag==0){
        array_push($cities, ['id'=>count($cities)+1, 'city'=>$user[$i]['address']]);     
    }
}
for ($i = 0; $i < count($user); $i++) {
     for ($j = 0; $j < count($cities); $j++) {
          if($user[$i]['address'] == $cities[$j]['city']){
                $user[$i]['address'] = $cities[$j]['id'];
          }
     }
}