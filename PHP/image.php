<?php

    $file = $_FILES; // 获取上传的文件
    if($file==null){
        exit(json_encode(array('code'=>1,'msg'=>'未上传图片')));
    }
    // 获取文件后缀
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    // 判断文件是否合法
    if(!in_array($extension,array("gif","jpeg","jpg","png"))){
        exit(json_encode(array('code'=>1,'msg'=>'上传图片不合法')));
    }

    if (file_exists("/data/wwwroot/3.0.1.2-opencart/images/" . $_FILES["file"]["name"])){
      	//echo $_FILES["file"]["name"] . " already exists. ";
    }else{
      	$info = move_uploaded_file($_FILES["file"]["tmp_name"],"/data/wwwroot/3.0.1.2-opencart/images/" . $_FILES["file"]["name"]);
      	//echo "Stored in: " . "/tmp/" . $_FILES["file"]["name"];
    }
    
    $img = "/images/" . $_FILES["file"]["name"];
    exit(json_encode(array('code'=>0,'msg'=>$img)));
 


?>

<script src="layui.js"></script>

<link rel="stylesheet" href="css/layui.css" media="all" />

<div class="layui-form-item">
    <label class="layui-form-label">图片</label>
    <div class="layui-input-block">
        <img id="pre_img" style="width: 100px;height: 100px;" />
        <button class="layui-btn layui-btn-sm" onclick="return false;" id="upload_img">
            <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
        <input type="hidden" name="img" value="">
    </div>
</div>


<script type="text/javascript">
layui.use(['upload','jquery'],function () {
    $ = layui.jquery;
    var upload = layui.upload;
    //执行实例
    var uploadInst = upload.render({
        elem: '#upload_img' //绑定元素
        ,url: 'index.php/upload_file' //上传接口
        ,accept:'images'
        ,done: function(res){
            //上传完毕回调
            $('#pre_img').attr('src',res.msg);
            $('input[name="img"]').val(res.msg);
        }
        ,error: function(){
            //请求异常回调
        }
    });
});
</script>
