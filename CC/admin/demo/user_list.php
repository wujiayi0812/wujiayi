<?php
header("Content-type:text/html;charset=utf-8");
//连接数据库
$con = mysqli_connect("localhost","root","","cinema");
if (!$con){
    die('Could not connect: ' . mysqli_error());
}
@$offset = $_REQUEST['offset'];//记录偏移量
if (empty($offset)) {
    $offset=0;         //第一页的起始记录偏移量
    $this_page_no=1;   //当前页为第一页
    $pages=1;
}
$page_size=10;     //每页显示记录的数量
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>表格</title>
    <link rel="stylesheet" href="../frame/layui/css/layui.css">
    <link rel="stylesheet" href="../frame/static/css/style.css">
    <link rel="icon" href="../frame/static/image/code.png">
</head>
<body class="body">


    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>用户列表</legend>
    </fieldset>

    <table class="layui-table">
        <colgroup>
        <col width="10%">
        <col width="25%">
        <col width="20%">
        <col width="20%">
        <col width="15%">
        <col width="20%">
    </colgroup>
    <thead>
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>密码</th>
            <th>邮箱</th>
            <th>手机</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php
        header("Content-type:text/html;charset=utf-8"); 
        $con = mysqli_connect("localhost","root","","cinema");
        if (!$con){
            die('Could not connect: ' . mysqli_error());
        }
        $q ="SELECT * FROM user";
        $res = mysqli_query($con, $q);

        $query="SELECT * FROM user order by id";
        $get = mysqli_query($con,$query);
            //统计要显示的记录总数
        $rec_count = mysqli_num_rows($get);
            //分页显示符合要求的记录
        $sql1="SELECT * FROM user order by id LIMIT $offset,$page_size";
        $get = mysqli_query($con,$sql1);

            //将res结果集中查询结果取出一条
        while($row=mysqli_fetch_assoc($res)){
            echo"<tr><td>".$row["id"].
            "</td><td>".$row["username"].
            "</td><td>".$row["password"].
            "</td><td>".$row["email"].
            "</td><td>".$row["tel"].
            "</td><td><a href='up_user.php?id={$row["id"]}'>"."修改"."</a>&nbsp;&nbsp;<a href='del_user.php?id={$row["id"]}'>"."删除"."</a></td>". 
            "</tr>";
        }
        ?>
    </tbody>
</table>
<form method="post" action="<? $_SERVER['PHP_SELF'];?>">
    <table class="layui-table">
        <tr>
            <th width=15%>记录数：<?php echo $rec_count ?></th>
            <th width=85% bgcolor="#FFFFFF"><a href="<?php echo $_SERVER['PHP_SELF'];?>?offset=0" target=_self>【首页】</a>&nbsp;&nbsp;
                <?php 
                if ($offset){//如果偏移量是0，不显示前一页的链接
                    $preoffset=$offset-$page_size;
                    echo "<a href='$_SERVER[PHP_SELF]?offset=$preoffset' target='_self'>【上一页】</a>&nbsp;&nbsp;";
                }

                //计算总共需要的页数
                $pages=ceil($rec_count/$page_size);
                //检查是否是最后一页
                $nextoffset=$offset+$page_size;
                if(($page_size!=0)&&($nextoffset<$rec_count))
                    echo "<a href='$_SERVER[PHP_SELF]?offset=$nextoffset' target='_self'>【下一页】</a>&nbsp;&nbsp;";
                $last_offset = ($pages-1)*$page_size;
                $this_page_no=ceil($offset/$page_size)+1;
                ?>
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?offset=<?php echo $last_offset ;?>" target=_self>【尾页】</a>&nbsp;&nbsp;页次：<font color="red"><?php echo $this_page_no; ?></font>/
                <?php echo $pages; ?>页
            </th>
        </tr>
    </table>
</form>

<script type="text/javascript" src="../frame/layui/layui.js"></script>
<script type="text/javascript">
    // you code ...


</script>
</body>
</html>