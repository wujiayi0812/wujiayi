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
$page_size=9;     //每页显示记录的数量
?>
<!DOCTYPE html>
<html>
<head>
	<title>电影购票站</title>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom Theme files -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Custom Theme files -->
	<script src="js/jquery.min.js"></script>
	<!-- Custom Theme files -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--webfont-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- header-section-starts -->
	<div class="full">
		<div class="menu">
			<ul>
				<li><a href="index.html"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
				<li><a class="active" href="videos.php"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
				
				<li><a href="reviews.html"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
				<li><a href="404.html"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
				<li><a href="contact.html"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
			</ul>
		</div>
		<div class="main">
			<div class="video-content">
				<div class="top-header span_top">
					<div class="logo">
						<a href="index.html"><img src="images/logo.png" alt="" /></a>
						<p>Movie Theater</p>
					</div>
					<div class="search v-search">
						<form>
							<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
							<input type="submit" value="">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="right-content">
					<div class="right-content-heading">
						<div class="right-content-heading-left">
							<h3 class="head">正在热映</h3>
						</div>
					</div>

					<div class='content-grids'>


						<?php 
						$query="SELECT * FROM movie order by movie_id";
						$get = mysqli_query($con,$query);
								//统计要显示的记录总数
						$rec_count = mysqli_num_rows($get);
								//分页显示符合要求的记录
						$sql1="SELECT * FROM movie order by movie_id LIMIT $offset,$page_size";
						$get = mysqli_query($con,$sql1);

						while($row=mysqli_fetch_assoc($get)){
							?>
							<div class="content-grid">
								<a class="play-icon popup-with-zoom-anim" href="<?php echo "single.php?movie_id={$row["movie_id"]}" ?>">
									<img src="<?php echo $row['pic'] ?>" name='pic' height="375px"/></a>
									<h3><?php echo $row['movie_name'] ?></h3>
									<ul>
										<li><a href="#"><img src="images/likes.png" title="image-name" /></a></li>
										<li><a href="#"><img src="images/views.png" title="image-name" /></a></li>
										<li><a href="#"><img src="images/link.png" title="image-name" /></a></li>
									</ul>
									<a class="button play-icon popup-with-zoom-anim" href="<?php echo "single.php?movie_id={$row["movie_id"]}" ?>">详情/购票</a>
								</div>
								<?php
							}
							?>



							<div class="clearfix"> 
							</div><form method="post" action="<? $_SERVER['PHP_SELF'];?>">
							<table >
								<tr>
									<th>影片数：<?php echo $rec_count ?></th>
									<th ><a href="<?php echo $_SERVER['PHP_SELF'];?>?offset=0" target=_self>【首页】</a>&nbsp;&nbsp;
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
					<!---start-pagenation->
					<div class="pagenation">
						<ul>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
					<!-End-pagenation->
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>	
	<div class="footer">
		<h6>Disclaimer : </h6>
		<p class="claim">This is a freebies and not an official website, I have no intention of disclose any movie, brand, news.My goal here is to train or excercise my skill and share this freebies.</p>
		<a href="example@mail.com">example@mail.com</a>
		<div class="copyright">
			<p> Template by  <a href="http://w3layouts.com">  W3layouts</a></p>
		</div>
	</div>	
	</div>
	<div class="clearfix"></div>
</div>-->
<!-- </body>
</html> -->