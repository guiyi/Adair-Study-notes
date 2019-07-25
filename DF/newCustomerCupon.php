<?php
//是否为新用户
	protected  function getLimitNewCustomer($name,$status){
		if(strstr($name,'New Customer')){
			//登录用户
			if($this->customer->getId()){
				$order_query = $this->db->query("select email from  `order`   where customer_id=".$this->customer->getId());
				if(isset($order_query->row['email'])){
					$email = $order_query->row['email'] ;
				}
			//未登录用户		
			}else{
	
				if(isset($this->session->data['guest']["email"])){
					$email = $this->session->data['guest']["email"] ;
				}

			}

			if(isset($email) && !empty($email)){
				//仅下单成功的客户
				$order_query1 = $this->db->query("select count(1) as alls,payment_code  from `order`   where email="."'".$this->db->escape($email)."'"."  and order_status_id!=0  GROUP BY payment_code");

				if($order_query1->rows){
					foreach ($order_query1->rows as $key => $value) {

							if(intval($value['alls'])>=1  ){
								$status = false;								
							}
							

					}
		
					//Default 仅终端用户可用
					if(intval($this->customer->getGroupId()) != 8){
						$status = false;
								
					}	
				}else{
					$status = true;
				}
		
				
			}
			
		}

		return $status;

	}
