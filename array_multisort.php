<?php

//1. DHL；2. FedEx；3. EMS；4. HK post；5. China Domestic Forwarder；6. Collect on Delivery；7. Pick up From Store


$sort_array = array('dhl'=>1,'fedex'=>2,'ems'=>3,'hk'=>4,'china'=>5,'collect'=>6,'pick'=>'7');
//var_dump($sort_array);
$weight_array = array('DHL (Zone 4) (Weight: 0.07kg)'=>'13','China Domestic Forwarder'=>'12','HK post'=>'10');
$new_weight_array =  array();
foreach($weight_array as $key=> $value){
    $w_title = explode( ' ',strtolower($key));
    if(isset($w_title[0])){
        $w_title = $w_title[0];
    }
    //$w_title = substr(strtolower($key), 0, 3);
    //echo $w_title;
   if(array_key_exists($w_title,$sort_array)){
       //echo $sort_array[$w_title];
       
       $new_weight_array[$key] = array('price'=>$value,'sort_order'=>$sort_array[$w_title]);
      // $weight_array['sort'] = $sort_array[$w_title];
   }
   
}
 foreach ($new_weight_array as $key => $row)
    {
        $volume[$key]  = $row['sort_order'];

    }

array_multisort($volume, SORT_ASC, $new_weight_array);

print_r($new_weight_array);
