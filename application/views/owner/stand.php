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
        	background-image: url(http://202ar.oss-cn-shenzhen.aliyuncs.com/owner_stand.jpg);
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
        .declare-box {
            display: block;
            margin: 10px auto;
            width: 70%;
            height: 10%;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            text-align: center;
        }
        .declare-box p{
            margin: 0;
            padding: 5px;
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
    	<h1 id="page_title">广场</h1>

    	<hr>
        <p align="right">
            <button id="main">刷新</button>
            <button id="share">分享</button>
        </p>
        <div class="declare-box">
            <p>听说你们有人想造反，到底是谁呢，我决定挑一个拷问一下</p>
        </div>
    	<div id="holder_box"><div id="holder">
	<?php
		foreach ($data as $item) {
			$tag = '<div class="neigborhood-list"><a class="slave_name" val="'. $item->id. '">'. urldecode($item->nickname). '</a></div>';
			echo $tag;
		}
	 ?>
	    </div></div>
		<div class="action-zoom">
	    	<button class="action-btn" id="back_palace">返回宫殿</button>
	    </div>
    </div>
	
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){

			$("#main").click(function(){
                location.href="http://www.hereprovides.com/slave/index.php/Player/enter";
            });
            $("#share").click(function(){
                location.href="http://www.hereprovides.com/slave/index.php/User/show";
            });
			$("#back_palace").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Player/enter";
			});
			$(".slave_name").click(function(){
				var link = "http://www.hereprovides.com/slave/index.php/Owner/suspect/" + $(this).attr("val");
				$.ajax({
					type: "get",
					url: link,
					dataType: "text",
					success: function(data){
						if(data == 'invalid'){
							alert('寡人还需要反省，不能随便怀疑别人');
						}else if (data == 'leader'){
							alert('抓到造反的头头了，我真是英明');
						}else if(data == 'follower') {
							alert('想造反，活得不耐烦了');
							//这里把奴隶列表里面刚被怀疑的人删掉
						}else if(data == 'fail'){
							alert('听信小人之言，错怪你了，待朕面壁思过');
						}
						
					}
				});
			});
		});
	</script>
</body>
</html>
