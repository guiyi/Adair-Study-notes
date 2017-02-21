<?php
/**
 * 
 * @param   php控制台调试 ;
 * @return  array
 * @author  adair
 */
if (!function_exists('phpConsole_log')) {

    function phpConsole_log( $data ){
      echo '<script>';
      echo 'console.log('. json_encode( $data ) .')';
      echo '</script>';
    }

}




/**
 * 购物车订单通用检查
 * @return  string
 * @author  adair
 */
if (!function_exists('check_common_order')) {
    function check_common_order($tempAttributeId,$number){
            $my_json = & get_instance();
            $my_obj =  & get_instance();

            //检查类型
            if($number<1) {
                $my_json->json->J(array(), 403, '购买数量不能小于1！');
            }
            //检查库存
            if ($tempAttributeId == NULL) {
                $my_json->json->J(array(), 403, '该商品类型为空！');
            }
            //取商品属性
            $attribute = $my_obj->common_m->get_one('shop_good_attribute',array('id'=>$tempAttributeId));
            //var_dump($attribute);
            if ($attribute) {
                //取父级商品属性
                $attribute_parent = $my_obj->common_m->get_one('shop_good_attribute',array('id'=>is_array_set($attribute,'parent_id',0)));
                /*if(!empty($attribute_parent)){
                    $this->data['attribute_parent'] = $attribute_parent;
                }*/
            }else {
                $my_json->json->J(array(), 403, '该父级商品类型为空！');
            }

            //判断品牌是否下架
            $brandName = $my_obj->common_m->get_one('shop_brand',array('id'=>$attribute['brand_id'],'status'=>1));
            //var_dump($brandName);
            if(empty($brandName)) {
                $my_json->json->J(array(), 403, '该品牌已下架');
            }

            //判断商品是否下架
            $good = $my_obj->common_m->get_one('shop_good',array('id'=>$attribute['good_id'],'status'=>1));
            if(empty($good)) {
                $my_json->json->J(array(), 403, '该商品已下架');
            }

            //商品属性 规格
            if(intval($attribute['parent_id']) === 0){
                $attribute_val = $attribute['key'].":".$attribute['val'];
            }else{
                $user_attribute2 = $my_obj->common_m->get_one('shop_good_attribute',array('id'=>$attribute['parent_id']));
                if(!empty($user_attribute2)){
                    $attribute_val = $attribute['key']." ".$attribute['val'].",".$user_attribute2['key']." ".$user_attribute2['val'];
                }else{
                    $attribute_val = "";
                }
            }

            $attribute['attribute_ids'] = $tempAttributeId;
            $attribute['b_price'] = $attribute['price'];
            $attribute['c_price'] = $attribute['price2'];
            $attribute['attribute_val'] = $attribute_val;
            $attribute = array_merge($attribute,$brandName,$good);
            //var_dump($attribute);


            return $attribute ;
        }
}
?>