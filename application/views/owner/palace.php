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
    </style>
</head>
<body>
    <div id="content">
        <h1 id="page_title">我的宫殿</h1>
        <hr>
        <p align="right">
            <button id="main">刷新</button>
            <button id="share">分享</button>
        </p>

        <div class="declare-box">
            <p>这里是的<?php echo urldecode($user->nickname);?>的宫殿</p>
            <p>下一步去做点什么呢</p>
        </div>
	    <div class="action-zoom">
	    	<button class"action-btn" id="go_jail">看看我的犯人</button>
	    	<button class="action-btn" id="go_stand">巡视我的奴隶</button>
	    	<button class="action-btn" id="neigborhood">挑一个对手干掉</button>
	    </div>
	    <div id="holder_box"><div id="holder"></div></div>
    </div>
	

	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function() {

            $("#main").click(function(){
                location.href="http://www.hereprovides.com/slave/index.php/Player/enter";
            });
            $("#share").click(function(){
                location.href="http://www.hereprovides.com/slave/index.php/User/show";
            });

			$("#go_stand").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Owner/asset";
			});
			
			$("#go_jail").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Owner/jail"
			});

			$("#neigborhood").click(function(){
				$.ajax({
					type: "get",
					url: "http://www.hereprovides.com/slave/index.php/User/nearby",
					dataType: "json",
					success: function(data){
						var html = '';
						for(var item in data){
							html += '<div class="neigborhood-list"><a href="http://www.hereprovides.com/slave/index.php/Slave/capture/' + data[item].id + '">' + decodeURIComponent(data[item].nickname) + '</a></div>';
							
						}
						$("#holder").html(html);
						$("#holder_box").show();
					}
				});
			});
		});
	</script>
</body>
</html>
