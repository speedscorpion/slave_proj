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
        	background-image: url(http://202ar.oss-cn-shenzhen.aliyuncs.com/owner_fight.jpg);
        	background-size: 100%;
        	background-position: center center;
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
        #holder_box {
        	display: block;
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
        	color: #00FF00
        }	/* 已访问的链接 */
        a:hover {
        	color: #FF00FF
        }	/* 鼠标移动到链接上 */
        a:active {
        	color: #0000FF
        }
    </style>
</head>
<body>
	<div id="content">
		<h1 id="page_title">战争结果</h1>

		<div class="action-zoom">
			<button class="action-btn" id="accept">接受结果</button>
			<button class="action-btn" id="give_free">释放奴隶</button>
			<button class="action-btn" id="my_slaves">霸占奴隶</button>
		</div>
	</div>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#accept").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Player/enter";
			});

			$("#give_free").click(function(){
				location.href=<?php echo "\"http://www.hereprovides.com/slave/index.php/Slave/free/".$enemy."\"" ?>;
			});

			$("#my_slaves").click(function(){
				location.href=<?php echo "\"http://www.hereprovides.com/slave/index.php/Slave/transfer/".$enemy."\"" ?>;
			});
		});
	</script>
</body>
</html>
