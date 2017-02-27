<?php
/*CI 高并发 事物处理
*author : adair
*/

//秒杀设置
$spike = _setSpike();
if(intval($user_attribute1['brand_id']) === intval($spike['brand_id'])){
    //取得商品属性信息
    $this->db->trans_begin(); // 开始事务
    $coSql = "SELECT * FROM shop_good_attribute WHERE status = 1 AND  id= ".$attribute." for update ";
    $user_attribute =  object_to_array($this->common_m->exec_sql_str($coSql, 'one'));
}else{
    $user_attribute = $this->common_m->get_one('shop_good_attribute',array('id'=>$attribute,'status'=>1));
}

if ($this->db->trans_status() === FALSE){
	$this->cache->memcached->save("TEST_ERROR_9001",'miaosha reduceStock'.'trans_rollback', 7200);
	//$this->db->trans_rollback(); // 回滚，并处理错误处理
	$this->json->J(array(), 403, '该商品类型已下架！');
	}else{
	$this->cache->memcached->save("TEST_ERROR_9002",'trans_commit', 7200);
	$this->db->trans_commit(); // 提交
	}
}

?>
