
<?php
//Author : Adair
//Date :   2018-11-11



define('L1','电池');
define('L2','磁铁');
define('L3','液体');


$product_arr = array(
    array('product_id'=>1,'name'=>'led','type'=>'L1'),
    array('product_id'=>2,'name'=>'sed','type'=>'L2'),
    array('product_id'=>3,'name'=>'ted','type'=>'L3'),
    array('product_id'=>101,'name'=>'led100','type'=>'L1')

    );
    
$arr1 = array();
foreach($product_arr as $key=>$value){
    $arr1[] =$value['type'];
}


$rst = cartRules($arr1);

$data['p1']= $data['p2'] = array();
foreach($product_arr as $key=>$value){
    if($rst == $value['type']){
        $data['p2'][] = $value;
    }else{
        $data['p1'][] = $value;
    }
   
}


var_dump($data);



function cartRules($arr1){
    //电池&磁铁, 扣电池
    if(in_array('L1',$arr1) && in_array('L2',$arr1)){
        return 'L1';
    }
    //电池&液体, 扣电池
    if(in_array('L1',$arr1) && in_array('L3',$arr1)){
        return 'L1';
    }
    //电池&磁铁&液体, 扣电池
    if(in_array('L1',$arr1) && in_array('L2',$arr1) &&  in_array('L3',$arr1) ){
        return 'L1';
    }
        
}


?>



