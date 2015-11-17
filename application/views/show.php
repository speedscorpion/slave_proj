<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Riot of Slaves</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <style type="text/css">
        html, body {
        	padding: 0;
        	margin: 0;
        	height: 100%;
        	width: 100%;
        	font-family: "Microsoft Yahei", "微软雅黑"
        }
        h1, ul, li {
        	margin: 0;
        	padding: 0;
        }
        #content {
        	width: 100%;
        	height: 100%;
        	background-image: url(http://202ar.oss-cn-shenzhen.aliyuncs.com/palace.jpg);
        	background-size: 100%;
        	background-position: center center;
        	text-align: center;
        }
        #page_title {
        	text-align: center;
        	padding: 20px 0 10px 0;
        	color: #FFF;
        	font-size: 23px;
        }
        .action-zoom {
        	/*margin-top: 10px;*/
        	text-align: center;
        }
        .action-btn {
        	margin: 10px;
        }
        .declare-box {
            display: block;
            margin: 0 auto;
            width: 70%;
            /*height: 10%;*/
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            text-align: center;
        }
        /*.declare-box p{
            margin: 0;
            padding: 5px;
        }*/
        #holder_box {
        	display: none;
        	margin: 0 auto;
        	width: 60%;
        	height: 35%;
        	overflow: hidden;
        	background-color: rgba(255, 255, 255, 0.6);
        	border-radius: 10px;
        }
        #holder {
        	width: 100%;
        	height: 100%;
        	overflow: auto;
        }
        .neigborhood-list {
        	padding: 7px 0 0 16px;
        }
        a {
        	font-weight: 900;
        	font-size: 17px;
        	text-decoration: none;
        }
        a:link {
        	color: #000;
        }		/* 未访问的链接 */
        a:visited {
        	color: #000
        }	/* 已访问的链接 */
        a:hover {
        	color: #000
        }	/* 鼠标移动到链接上 */
        a:active {
        	color: #000
        }
        .data-box {
        	height: 30px;
        	width: 100%;
        }
        .data-label {
        	float: left;
        	width: 40%;
        }
        .data-p {
        	float: left;
        	width: 60%;
        	margin: 0;
        	padding: 0;
        }
        .data-line {
        	width: 100%;
            height: 35px;
            line-height: 35px;
        }
        .erweima-pic-box {
        	margin: 30px auto;
            width: 50%;
        }
        .erweima-pic-box img {
        	width: 100%;
        }
    </style>
</head>
<body>
<div id="content">
    <h1 id="page_title"><?php echo urldecode($user->nickname). " " ?>游戏成就</h1>
	<div class="declare-box">
	    <div class="data-line">
	    	<label class="data-label">朕的奴隶</label>
	    	<p class="data-p">有
	    	<?php
	    	$i = 0;
			foreach ($owner_record as $item) {
				$i++;
				// $tag = "<a href='http://www.hereprovides.com/slave/index.php/User/state/".$item->id."'>".$item->nickname."</a><br/>";
				// echo $tag;
			}
			echo $i
		    ?>
	    	人</p>
	    </div>


		<div class="data-line">
	    	<label class="data-label">我的主人</label>
	    	<p class="data-p">
	    	<?php
			foreach ($slave_record as $item) {
				$tag = "<a href='http://www.hereprovides.com/slave/index.php/User/state/".$item->id."'>".urldecode($item->nickname)."</a><br/>";
				echo $tag;
			}
		    ?>
	    	</p>
	    </div>





        <div class="data-line">
	    	<label class="data-label">平定叛乱</label>
	    	<p class="data-p">有
	    	<?php 
			echo $handle_count. '次';
		    ?>
	    	</p>
	    </div>


        <div class="data-line">
	    	<label class="data-label">推翻暴政</label>
	    	<p class="data-p">有
	    	<?php 
			echo $raise_count. '次';
		    ?>
	    	</p>
	    </div>





	</div>
    
    <div class="erweima-pic-box"><img src="http://202ar.oss-cn-shenzhen.aliyuncs.com/24.pic.jpg"></div>
	<!-- <a href="http://www.hereprovides.com/slave/index.php/Player/enter">join game</a> -->
	<button style="margin: 0 auto" id="copy_btn">复制分享地址</button>
	<!-- <a href=<?php echo "'http://www.hereprovides.com/slave/index.php/User/state/". $user->id. "'" ?> >share link</a> -->
</div>
	
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript"></script>
	<script type="text/javascript">
	$('#copy_btn').on('click', function () {
	    alert(<?php echo "'http://www.hereprovides.com/slave/index.php/User/state/". $user->id. "'" ?>);
	});


	</script>
</body>
</html>