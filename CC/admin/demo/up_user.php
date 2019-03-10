<?php
$id = $_GET{"id"};
$db = mysqli_connect("localhost","root","","cinema");
$sql = "SELECT * FROM user WHERE id='{$id}'";
$r = $db->query($sql);
//mysqli_fetch_row() 函数从结果集中取得一行作为数字数组
$arr = $r->fetch_row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
    <link rel="stylesheet" href="../frame/layui/css/layui.css">
    <link rel="stylesheet" href="../frame/static/css/style.css">
    <link rel="icon" href="../frame/static/image/code.png">
</head>
<body class="body">
    <div class="upload">   
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>修改用户信息</legend>
        </fieldset>

        <form action="../PHP/ud_u.php" method="post" class="layui-form"> 
        <div class="layui-form-item">
            <label class="layui-form-label">用户id</label>
                <div class="layui-input-block">
                    <input type="text" readonly="readonly" name="id"class="layui-input" value="<?php echo $arr[0];?>"/>
                </div>
            </div>
            <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="username"   class="layui-input" value="<?php echo $arr[1];?>"/>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password"  class="layui-input" value="<?php echo $arr[2];?>"/>
                </div>
            </div>
            
            <div class="layui-form-item">
                <label class="layui-form-label">手机</label>
                <div class="layui-input-block">
                    <input type="number" name="tel"   class="layui-input" value="<?php echo $arr[3];?>"/>
                </div>
            </div>  
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" class="layui-input" value="<?php echo $arr[4];?>"/>
                </div>
            </div>
            <div class="layui-form-item">
                <input class="layui-btn"  lay-filter="demo2" type="submit" name="Submit" value="修改完毕"/>
            </div>  
        </form>
    </div>
    <script type="text/javascript" src="../frame/layui/layui.js"></script>
    <script type="text/javascript">
        // you code ...


    </script>
</body>
</html>