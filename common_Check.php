< ?php 
// ※CheckMoney($C_Money) 检查数据是否是99999.99格式
// ※CheckEmailAddr($C_mailaddr) 判断是否为有效邮件地址
// ※CheckWebAddr($C_weburl) 判断是否为有效网址
// ※CheckEmpty($C_char) 判断字符串是否为空
// ※CheckLengthBetween($C_char, $I_len1, $I_len2=100) 判断是否为指定长度内字符串
// ※CheckUser($C_user) 判断是否为合法用户名
// ※CheckPassword($C_passwd) 判断是否为合法用户密码
// ※CheckTelephone($C_telephone) 判断是否为合法电话号码
// ※CheckValueBetween($N_var, $N_val1, $N_val2) 判断是否是某一范围内的合法值
// ※CheckPost($C_post) 判断是否为合法邮编（固定长度）
// ※CheckExtendName($C_filename,$A_extend) 判断上传文件的扩展名
// ※CheckImageSize($ImageFileName,$LimitSize) 检验上传图片的大小
// ※AlertExit($C_alert,$I_goback=0) 非法操作警告并退出
// ※Alert($C_alert,$I_goback=0) 非法操作警告
// ※ReplaceSpacialChar($C_char) 特殊字符替换函数
// ※ExchangeMoney($N_money) 资金转换函数
// ※WindowLocation($C_url,$C_get="",$C_getOther="") PHP中的window.location函数 
 
// 函数名：CheckMoney($C_Money)     
// 作 用：检查数据是否是99999.99格式     
// 参 数：$C_Money（待检测的数字）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckMoney($C_Money)     
{     
if (!ereg("^[0-9][.][0-9]$", $C_Money)) return false;     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckEmailAddr($C_mailaddr)     
// 作 用：判断是否为有效邮件地址     
// 参 数：$C_mailaddr（待检测的邮件地址）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckEmailAddr($C_mailaddr)     
{     
if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$",     
$C_mailaddr))     
//(!ereg("^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$",     
$c_mailaddr))     
{     
return false;     
}     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckWebAddr($C_weburl)     
// 作 用：判断是否为有效网址     
// 参 数：$C_weburl（待检测的网址）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckWebAddr($C_weburl)     
{     
if (!ereg("^http://[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$", $C_weburl))     
{     
return false;     
}     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckEmpty($C_char)     
// 作 用：判断字符串是否为空     
// 参 数：$C_char（待检测的字符串）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckEmptyString($C_char)     
{     
if (!is_string($C_char)) return false; //是否是字符串类型     
if (empty($C_char)) return false; //是否已设定     
if ($C_char=='') return false; //是否为空     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckLengthBetween($C_char, $I_len1, $I_len2=100)     
// 作 用：判断是否为指定长度内字符串     
// 参 数：$C_char（待检测的字符串）     
// $I_len1 （目标字符串长度的下限）     
// $I_len2 （目标字符串长度的上限）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckLengthBetween($C_cahr, $I_len1, $I_len2=100)     
{     
$C_cahr = trim($C_cahr);     
if (strlen($C_cahr) < $I_len1) return false;     
if (strlen($C_cahr) > $I_len2) return false;     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckUser($C_user)     
// 作 用：判断是否为合法用户名     
// 参 数：$C_user（待检测的用户名）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckUser($C_user)     
{     
if (!CheckLengthBetween($C_user, 4, 20)) return false; //宽度检验     
if (!ereg("^[_a-zA-Z0-9]*$", $C_user)) return false; //特殊字符检验     
return true;     
}     
?>
 
 
< ?php 
 
 
// 函数名：CheckPassword($C_passwd)     
// 作 用：判断是否为合法用户密码     
// 参 数：$C_passwd（待检测的密码）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckPassword($C_passwd)     
{     
if (!CheckLengthBetween($C_passwd, 4, 20)) return false; //宽度检测     
if (!ereg("^[_a-zA-Z0-9]*$", $C_passwd)) return false; //特殊字符检测     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckTelephone($C_telephone)     
// 作 用：判断是否为合法电话号码     
// 参 数：$C_telephone（待检测的电话号码）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckTelephone($C_telephone)     
{     
if (!ereg("^[+]?[0-9]+([xX-][0-9]+)*$", $C_telephone)) return false;     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckValueBetween($N_var, $N_val1, $N_val2)     
// 作 用：判断是否是某一范围内的合法值     
// 参 数：$N_var 待检测的值     
// $N_var1 待检测值的上限     
// $N_var2 待检测值的下限     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckValueBetween($N_var, $N_val1, $N_val2)     
{     
if ($N_var < $N_var1 ││ $N_var > $N_var2)     
{     
return false;     
}     
return true;     
 
 
}     
 
 
?>
 
 
< ?php 
 
 
// 函数名：CheckPost($C_post)     
// 作 用：判断是否为合法邮编（固定长度）     
// 参 数：$C_post（待check的邮政编码）     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckPost($C_post)     
{     
$C_post=trim($C_post);     
if (strlen($C_post) == 6)     
{     
if(!ereg("^[+]?[_0-9]*$",$C_post))     
{     
return true;;     
}else     
{     
return false;     
}     
}else     
{     
return false;;     
}     
}     
//-----------------------------------------------------------------------------------     
 
 
// 函数名：CheckExtendName($C_filename,$A_extend)     
// 作 用：上传文件的扩展名判断     
// 参 数：$C_filename 上传的文件名     
// $A_extend 要求的扩展名     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckExtendName($C_filename,$A_extend)     
{     
if(strlen(trim($C_filename)) < 5)     
{     
return 0; //返回0表示没上传图片     
}     
$lastdot = strrpos($C_filename, "."); //取出.最后出现的位置     
$extended = substr($C_filename, $lastdot+1); //取出扩展名     
 
 
for($i=0;$i{     
if (trim(strtolower($extended)) == trim(strtolower($A_extend[$i]))) //转换大     
小写并检测     
{     
$flag=1; //加成功标志     
$i=count($A_extend); //检测到了便停止检测     
}     
}     
 
 
if($flag<>1)     
{     
for($j=0;$j{     
$alarm .= $A_extend[$j]." ";     
}     
AlertExit('只能上传'.$alarm.'文件！而你上传的是'.$extended.'类型的文件');     
return -1; //返回-1表示上传图片的类型不符     
}     
 
 
return 1; //返回1表示图片的类型符合要求     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：CheckImageSize($ImageFileName,$LimitSize)     
// 作 用：检验上传图片的大小     
// 参 数：$ImageFileName 上传的图片名     
// $LimitSize 要求的尺寸     
// 返回值：布尔值     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function CheckImageSize($ImageFileName,$LimitSize)     
{     
$size=GetImageSize($ImageFileName);     
if ($size[0]>$LimitSize[0] ││ $size[1]>$LimitSize[1])     
{     
AlertExit('图片尺寸过大');     
return false;     
}     
return true;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：Alert($C_alert,$I_goback=0)     
// 作 用：非法操作警告     
// 参 数：$C_alert（提示的错误信息）     
// $I_goback（返回到那一页）     
// 返回值：字符串     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function Alert($C_alert,$I_goback=0)     
{     
if($I_goback<>0)     
{     
echo " ";     
}     
else     
{     
echo " ";     
}     
}     
?> 
 
 
< ?php 
 
 
// 函数名：AlertExit($C_alert,$I_goback=0)     
// 作 用：非法操作警告     
// 参 数：$C_alert（提示的错误信息）     
// $I_goback（返回到那一页）     
// 返回值：字符串     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function AlertExit($C_alert,$I_goback=0)     
{     
if($I_goback<>0)     
{     
echo " ";     
exit;     
}     
else     
{     
echo " ";     
exit;     
}     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：ReplaceSpacialChar($C_char)     
// 作 用：特殊字符替换函数     
// 参 数：$C_char（待替换的字符串）     
// 返回值：字符串     
// 备 注：这个函数有问题，需要测试才能使用 
//-----------------------------------------------------------------------------------     
 
 
function ReplaceSpecialChar($C_char)     
{     
$C_char=HTMLSpecialChars($C_char); //将特殊字元转成 HTML 格式。     
$C_char=nl2br($C_char); //将回车替换为     
 
 
$C_char=str_replace(" "," ",$C_char); //替换空格为     
return $C_char;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：ExchangeMoney($N_money)     
// 作 用：资金转换函数     
// 参 数：$N_money（待转换的金额数字）     
// 返回值：字符串     
// 备 注：本函数示例：$char=ExchangeMoney(5645132.3155) ==> $char='￥5,645,132.31'     
//-----------------------------------------------------------------------------------     
 
 
function ExchangeMoney($N_money)     
{     
$A_tmp=explode(".",$N_money ); //将数字按小数点分成两部分，并存入数组$A_tmp     
$I_len=strlen($A_tmp[0]); //测出小数点前面位数的宽度     
 
 
if($I_len%3==0)     
{     
$I_step=$I_len/3; //如前面位数的宽度mod 3 = 0 ,可按，分成$I_step 部分     
}else     
{     
$step=($len-$len%3)/3+1; //如前面位数的宽度mod 3 != 0 ,可按，分成$I_step 部分+1     
}     
 
 
$C_cur="";     
//对小数点以前的金额数字进行转换     
while($I_len<>0)     
{     
$I_step--;     
 
 
if($I_step==0)     
{     
$C_cur .= substr($A_tmp[0],0,$I_len-($I_step)*3);     
}else     
{     
$C_cur .= substr($A_tmp[0],0,$I_len-($I_step)*3).",";     
}     
 
 
$A_tmp[0]=substr($A_tmp[0],$I_len-($I_step)*3);     
$I_len=strlen($A_tmp[0]);     
}     
 
 
//对小数点后面的金额的进行转换     
if($A_tmp[1]=="")     
{     
$C_cur .= ".00";     
}else     
{     
$I_len=strlen($A_tmp[1]);     
if($I_len&lt;2)     
{     
$C_cur .= ".".$A_tmp[1]."0";     
}else     
{     
$C_cur .= ".".substr($A_tmp[1],0,2);     
}     
}     
 
 
//加上人民币符号并传出     
$C_cur="￥".$C_cur;     
return $C_cur;     
}     
 
 
 
//-----------------------------------------------------------------------------------     
 
 
 
// 函数名：WindowLocation($C_url,$C_get="",$C_getOther="")     
// 作 用：PHP中的window.location函数     
// 参 数：$C_url 转向窗口的URL     
// $C_get GET方法参数     
// $C_getOther GET方法的其他参数     
// 返回值: 字符串     
// 备 注：无     
//-----------------------------------------------------------------------------------     
 
 
function WindowLocation($C_url,$C_get="",$C_getOther="")     
{     
if($C_get == "" && $C_getOther == "")     
if($C_get == "" && $C_getOther <> ""){$C_target=""window.location='$C_url?     
$C_getOther='+this.value"";}     
if($C_get <> "" && $C_getOther == ""){$C_target=""window.location='$C_url?     
$C_get'"";}     
if($C_get <> "" && $C_getOther <> ""){$C_target=""window.location='$C_url?     
$C_get&$C_getOther='+this.value"";}     
return $C_target;     
}     
 
 
?>
