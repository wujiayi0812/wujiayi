<?php
header("Content-type:text/html;charset=utf-8");
//连接数据库
$con = mysqli_connect("localhost","root","","cinema");
if (!$con){
    die('Could not connect: ' . mysqli_error());
}
$offset = $_REQUEST['offset'];//记录偏移量
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
        <legend>影片列表</legend>
    </fieldset>

    <table class="layui-table">
        <colgroup>
        <col width="10%">
        <col width="22%">
        <col width="33%">
        <col width="10%">
        <col width="15%">
    </colgroup>
    <thead>
        <tr>
            <th>影片编号</th>
            <th>影片名</th>
            <th>主演</th>
            <th>影片类型</th>
            <th>海报路径</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $query="SELECT * FROM movie order by movie_type = '动作'";
        $get = mysqli_query($con,$query);
            //统计要显示的记录总数
        $rec_count = mysqli_num_rows($get);
            //分页显示符合要求的记录
        $sql1="SELECT * FROM movie order by movie_type LIMIT $offset,$page_size";
        $get = mysqli_query($con,$sql1);

     while ($r=mysqli_fetch_object($get)){
            echo "<tr><td height=24 width=10%>$r->movie_id</td>";
            echo "<td height=24 width=25%>$r->movie_name</td>";
            echo "<td height=24 width=30%>$r->star</td>";
            echo "<td height=24 width=10%>$r->movie_type</td>";
            echo "<td height=24 width=15%>$r->pic</td>";
        }
        echo "</tr>";
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