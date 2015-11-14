<!DOCTYPE html>
<html>
<head>
	<title>owner jail</title>
	<meta charset="utf-8"/>
</head>
<body>
	<h1>my prison</h1>
	<hr>
		<?php
			foreach ($data as $item) {
				$tag = "<button class=\"slave_name\" val=\"". $item->id. "\">". $item->nickname. "</button><br/>";
				echo $tag;
			}
		 ?>
	<hr>
	<button id="back_palace">my palace</button>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#back_palace").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Player/enter";
			});

			$(".slave_name").click(function(){
				alert('laught at' + $(this).attr(val));
			});
		});
	</script>
</body>
</html>