<?php
$movie_id= $_GET{"movie_id"};
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


$sql = "SELECT * FROM movie WHERE movie_id='{$movie_id}'";
$r = $con->query($sql);
$arr = $r->fetch_row();
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
				<li><a class="active" href=""><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
				<li><a href="reviews.html"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
				<li><a href="404.html"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
				<li><a href="contact.html"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
			</ul>
		</div>
		<div class="main">
			<div class="single-content">
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
				<div class="reviews-section">
					<h3 class="head">影片详情</h3>
					<div class="col-md-9 reviews-grids">
						<div class="review">
							<div class="movie-pic">
								<a href=""><img src="<?php echo $arr[1];?>" alt="" width="241px" height="363px"/></a>
							</div>
							<div class="review-info">
								<a class="span" href=""><i><?php echo $arr[2];?></i></a>
								<p class="info" style="margin-top: 10px">主演:&nbsp;&nbsp;<?php echo $arr[3];?></p>
								<p class="info">影片类型:&nbsp;&nbsp;<?php echo $arr[4];?></p>
								<div class="info" style="height: 200px;">影片简介:<p style="text-indent: 2em;"><?php echo $arr[5];?></p></div>

							</div>
							<div class="rtm text-center">
								<a href="seat.php?movie_id={$row["movie_id"]}">选座购票</a>
							</div>
							<div class="wt text-center">
								<a href="videos.php">返回上页</a>
							</div>
							<div class="clearfix"></div>
						</div>

						<!-- comments-section-starts -->
						<div class="comments-section">
							<div class="comments-section-head">
								<div class="comments-section-head-text">
									<h3>评论：</h3>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="comments-section-grids">
								<div class="comments-section-grid">
									<?php
									// header("Content-type:text/html;charset=utf-8"); 
									$con = mysqli_connect("localhost","root","","cinema");
									if (!$con){
										die('Could not connect: ' . mysqli_error());
									}
									$q ="SELECT * FROM comment";
									$res = mysqli_query($con, $q);

									$query="SELECT * FROM comment order by id";
									$get = mysqli_query($con,$query);
            						//统计要显示的记录总数
									$rec_count = mysqli_num_rows($get);
           						 //分页显示符合要求的记录
									$sql1="SELECT * FROM comment order by id LIMIT $offset,$page_size";
									$get = mysqli_query($con,$sql1);
									while($row=mysqli_fetch_assoc($get)){
										echo "<div class='col-md-10 comments-section-grid-text'>
										<h4><a href=''>".$row['username']."</a></h4>
										<label>".$row['movie_name']."</label>&nbsp;&nbsp;<label>".$row['time']."</label><p>".$row['comment']."</p>
										<i class='rply-arrow'></i>
									</div>";}
									?>


									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- comments-section-ends -->
						<div class="reply-section">
							<div class="reply-section-head">
								<div class="reply-section-head-text">
									<h3>我要评论</h3>
								</div>
							</div> 
							<div class="blog-form">
								<form action="../admin/PHP/comment.php" method="post">
									<input type="text" class="text" name="username" placeholder="用户名">
									<input type="text" class="text" name="movie_name"  placeholder="影片名">
									<textarea name="comment"></textarea>
									<input type="submit" value="提交评论" name="Submit">
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-3 side-bar">
						<div class="featured">
							<h3>Featured Today in Movie Reviews</h3>
							<ul>
								<li>
									<a href="single.html"><img src="images/f1.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f2.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f3.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f4.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f5.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<li>
									<a href="single.html"><img src="images/f6.jpg" alt="" /></a>
									<p>lorem movie review</p>
								</li>
								<div class="clearfix"></div>
							</ul>
						</div>

						<div class="entertainment">
							<h3>Featured Today in Entertainment</h3>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f6.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f5.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f3.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f4.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f2.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
							<ul>
								<li class="ent">
									<a href="single.html"><img src="images/f1.jpg" alt="" /></a>
								</li>
								<li>
									<a href="single.html">Watch ‘Bombay Velvet’ trailer during WC match</a>

								</li>
								<div class="clearfix"></div>
							</ul>
						</div>
						<div class="might">
							<h4>You might also like</h4>
							<div class="might-grid">
								<div class="grid-might">
									<a href="single.html"><img src="images/mi.jpg" class="img-responsive" alt=""> </a>
								</div>
								<div class="might-top">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
									<a href="single.html">Lorem Ipsum <i> </i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="might-grid">
								<div class="grid-might">
									<a href="single.html"><img src="images/mi1.jpg" class="img-responsive" alt=""> </a>
								</div>
								<div class="might-top">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
									<a href="single.html">Lorem Ipsum <i> </i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="might-grid">
								<div class="grid-might">
									<a href="single.html"><img src="images/mi2.jpg" class="img-responsive" alt=""> </a>
								</div>
								<div class="might-top">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
									<a href="single.html">Lorem Ipsum <i> </i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="might-grid">
								<div class="grid-might">
									<a href="single.html"><img src="images/mi3.jpg" class="img-responsive" alt=""> </a>
								</div>
								<div class="might-top">
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
									<a href="single.html">Lorem Ipsum <i> </i></a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<!---->
						<div class="grid-top">
							<h4>Archives</h4>
							<ul>
								<li><a href="single.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></li>
								<li><a href="single.html">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</a></li>
								<li><a href="single.html">When an unknown printer took a galley of type and scrambled it to make a type specimen book. </a> </li>
								<li><a href="single.html">It has survived not only five centuries, but also the leap into electronic typesetting</a> </li>
								<li><a href="single.html">Remaining essentially unchanged. It was popularised in the 1960s with the release of </a> </li>
								<li><a href="single.html">Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing </a> </li>
								<li><a href="single.html">Software like Aldus PageMaker including versionsof Lorem Ipsum.</a> </li>
							</ul>
						</div>
						<!---->

					</div>

					<div class="clearfix"></div>
				</div>
			</div>
			<div class="review-slider">
				<ul id="flexiselDemo1">
					<li><img src="images/r1.jpg" alt=""/></li>
					<li><img src="images/r2.jpg" alt=""/></li>
					<li><img src="images/r3.jpg" alt=""/></li>
					<li><img src="images/r4.jpg" alt=""/></li>
					<li><img src="images/r5.jpg" alt=""/></li>
					<li><img src="images/r6.jpg" alt=""/></li>
				</ul>
				<script type="text/javascript">
					$(window).load(function() {

						$("#flexiselDemo1").flexisel({
							visibleItems: 6,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: false,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems: 2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>	
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
	</div>
</body>
</html>