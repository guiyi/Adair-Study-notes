<?php
header("Content-type: text/html; charset=utf-8"); 

// ------------------------------------------------------------------------
/**
 * 根据IP查找地址
 * @access public
 * @param string 如180.173.185.247
 * @return string
 */
if (!function_exists('getAdressByIp')) {

    function getAdressByIp($ip) {
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=' . $ip;
        $ch = curl_init($url);
        //这使得能够解码响应的内容。 支持的编码有"identity"，"deflate"和"gzip"。如果为空字符串""，会发送所有支持的编码类型。
        curl_setopt($ch, CURLOPT_ENCODING, 'utf8');
        //允许 cURL 函数执行的最长秒数。
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        //TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
        $location = curl_exec($ch);
        $location = json_decode($location);
        curl_close($ch);
        $loc = "";
        if ($location === FALSE)
            return "";
        if (empty($location->desc)) {
            if (isset($location->province)) {
                $loc = $location->province . $location->city . $location->district . $location->isp;
            }
        } else {
            $loc = $location->desc;
        }
        return $loc;
    }

}

$ip = getAdressByIp($ip = "180.173.185.247");
var_dump($ip);
echo "\n\t<BR />";



/**
 * 获取接口数据
 * @param  [type] $url  [description]
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function https_request($url, $data = null) {
    if (function_exists ( 'curl_init' )) {
        $curl = curl_init ();
        //需要获取的 URL 地址
        curl_setopt ( $curl, CURLOPT_URL, $url );
        //要验证的交换证书可以在 CURLOPT_CAINFO 选项中设置，或在 CURLOPT_CAPATH中设置证书目录。
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        //设置为 1 是检查服务器SSL证书中是否存在一个公用名(common name)。译者注：公用名(Common Name)一般来讲就是填写你将要申请SSL证书的域名 (domain)或子域名(sub domain)。 设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 0 为不检查名称。 在生产环境中，这个值应该是 2（默认值）。
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        //CURL_SSLVERSION_DEFAULT (0), CURL_SSLVERSION_TLSv1 (1), CURL_SSLVERSION_SSLv2 (2), CURL_SSLVERSION_SSLv3 (3), CURL_SSLVERSION_TLSv1_0 (4), CURL_SSLVERSION_TLSv1_1 (5) ， CURL_SSLVERSION_TLSv1_2 (6) 中的其中一个。
        curl_setopt ( $curl, CURLOPT_SSLVERSION, FALSE );
        if (! empty ( $data )) {
        	//TRUE 时会发送 POST 请求
            curl_setopt ( $curl, CURLOPT_POST, 1 );
            //全部数据使用HTTP协议中的 "POST" 操作来发送
            curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
        }
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec ( $curl );
        curl_close ( $curl );
        return $output;
    } else {
        return false;
    }
}

$data = https_request($url = "http://www.baidu.com", $data = null);
var_dump($data);
echo "\n\t<BR />";


//通过access_token的值来获得ticket的值
function ticket($access_token)
{
	$cachedata = $this->ObjCached->get( PREFIX.'wx_ticket' );
	//$this->_CI->session->userdata()
	if( ! $cachedata ){
		$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
		
		$curl = curl_init();
		// 设置你需要抓取的URL
		curl_setopt($curl, CURLOPT_URL, $url);
		// 设置header
		//curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// 运行cURL，请求网页
		$data = curl_exec($curl);
		// 关闭URL请求
		curl_close ( $curl );
		$rst = json_decode($data,true);
		//$this->_CI->session->set_userdata(array(PREFIX."wx_ticket"=>base64_encode($rst['ticket']))); 
		$this->ObjCached->set( PREFIX."wx_ticket" , base64_encode( $rst['ticket'] ) , 600);
		return $rst['ticket'];
	}else{
		//return base64_decode($this->_CI->session->userdata(PREFIX."wx_ticket"));
		return base64_decode($cachedata);
	}

}


//获得access_token的值
function accessToken()
{
	$cachedata = $this->ObjCached->get( $this->StrKey );
	if( !$cachedata )
	{
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
		$curl = curl_init();
		// 设置你需要抓取的URL
		curl_setopt($curl, CURLOPT_URL, $url);
		// 设置header
		//curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// 运行cURL，请求网页
		$data = curl_exec($curl);
		// 关闭URL请求

		#放入缓存当中
		$this->ObjCached->set($this->StrKey,base64_encode($data),600);
		//$this->_CI->session->set_userdata(array(PREFIX."wx_accesstoken"=>base64_encode($data))); 
	}
}


/**
 * post方式请求资源
 * @param array $keysArr	请求的参数列表
 * @param string $url		基于的baseUrl
 * @param int $flag			标志位https
 * @return string			返回的资源内容
 */
function post($url = NULL, $keysArr, $flag = 0){
	$ch = curl_init();
	if(! $flag)
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//htts
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);//不输出到浏览器
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($keysArr));
	curl_setopt($ch, CURLOPT_URL, $url);
	$out = curl_exec($ch);
	curl_close($ch);
	$result = object_to_array(json_decode($out));
	return $result;
}

/**
 * get方式请求资源
 * @param unknown $url
 * @return mixed
 */
function get($url){
	//初始化
	$ch = curl_init();
	//设置选项，包括URL
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//启用时会将头文件的信息作为数据流输出。
	curl_setopt($ch, CURLOPT_HEADER, 0);
	//执行并获取HTML文档内容
	$out = curl_exec($ch);

	//释放curl句柄
	curl_close($ch);
	$result = object_to_array(json_decode($out));
	return $out;
}


/**
 * 	作用：使用证书，以post方式提交xml到对应的接口url
 */
function postXmlSSLCurl($xml,$url,$second=30)
{
	$ch = curl_init();
	//超时时间
	curl_setopt($ch,CURLOPT_TIMEOUT,$second);
	//这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
	//设置header
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	//要求结果为字符串且输出到屏幕上
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	//设置证书
	//使用证书：cert 与 key 分别属于两个.pem文件
	//默认格式为PEM，可以注释
	curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
	curl_setopt($ch,CURLOPT_SSLCERT, SSLCERT_PATH);
	//默认格式为PEM，可以注释
	curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
	curl_setopt($ch,CURLOPT_SSLKEY, SSLKEY_PATH);
	//post提交方式
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
	$data = curl_exec($ch);
	//返回结果
	if($data){
		curl_close($ch);
		return $data;
	}
	else { 
		$error = curl_errno($ch);
		echo "curl出错，错误码:$error"."<br>"; 
		echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
		curl_close($ch);
		return false;
	}
}



/**
 * 	作用：通过curl向微信提交code，以获取openid
 */
function getOpenid()
{
	$url = $this->createOauthUrlForOpenid();
    //初始化curl
   	$ch = curl_init();
	//设置超时
	curl_setopt($ch, CURLOPT_TIMEOUT, $this->curl_timeout);
	curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	//运行curl，结果以jason形式返回
    $res = curl_exec($ch);
	curl_close($ch);
	//取出openid
	$data = json_decode($res,true);
	$this->openid = $data['openid'];
	return $this->openid;
}

?>
