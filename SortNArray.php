//获取支付列表--重新排序
// adair 2017-08-10 start
$payment = get_online_payment_list(false);
$payList = [];
foreach ($payment as $key => $value) {
    
    if( $value["pay_id"] == 3){
        $payment[$key]["flag"] = 0;
    }elseif( $value["pay_id"] == 7){
        $payment[$key]["flag"] = 1;
    }elseif( $value["pay_id"] == 6){
        $payment[$key]["flag"] = 2;
    }else{
        $payment[$key]["flag"] = 3;
    }
}

foreach ($payment as $key1 => $value1) {
    $payList[$key1] = $value1['flag'];
}
array_multisort($payList, SORT_ASC, $payment);
// adair 2017-08-10 end
