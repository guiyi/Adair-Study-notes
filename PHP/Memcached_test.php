<?php
//@Memcached 作为测试
//@author  adair
public function couponUsinig8() {
    $data8 = array();
    $data8=$this->cache->memcached->get("couponUsinig8");
    $this->cache->memcached->save("couponUsinig8",'start' , 7200);
    var_dump($data8);

    $data9 = array();
    $data9=$this->cache->memcached->get("couponUsinig9");
    $this->cache->memcached->save("couponUsinig9",'start' , 7200);
    var_dump($data9);

    $data10 = array();
    $data10=$this->cache->memcached->get("couponUsinig10");
    $this->cache->memcached->save("couponUsinig10",'start' , 7200);
    var_dump($data10);


    $data11 = array();
    $data11=$this->cache->memcached->get("couponUsinig11");
    $this->cache->memcached->save("couponUsinig11",'start' , 7200);
    var_dump($data11);


    $data12 = array();
    $data12=$this->cache->memcached->get("couponUsinig12");
    $this->cache->memcached->save("couponUsinig12",'start' , 7200);
    var_dump($data12);

    $data13 = array();
    $data13=$this->cache->memcached->get("couponUsinig13");
    $this->cache->memcached->save("couponUsinig13",'start' , 7200);
    var_dump($data13);
}

?>
