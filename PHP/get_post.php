//过来特殊字符
	public static function GetFormSubmit($params)
	{
	    //$mysqlchar = array("~", "`", "#", "$", "%", "^", "&", "*/", "(", ")", "--", "+", "=", "{", "}", "[", "]", ";", "<", ">","?");
	    $mysqlchar = array("~", "`", "#", "$", "%", "^", "&", "*/", "(", ")","+", "=", "{", "}", "[", "]", ";", "<", ">","?");
	    if(is_array($params)) {
	        foreach ($params as $key => $value) {
	            $params[$key] = self::GetFormSubmit($value);
	        }
	    } else {
	        $params = str_replace($mysqlchar,"",$params);
	    }
	    return $params;
	}
