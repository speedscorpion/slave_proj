<!DOCTYPE html>
<html>
<head>
	<title>stand</title>
	<meta charset="utf-8"/>
</head>
<body>
	<h1>my stand</h1>
	<hr>
	<?php
		foreach ($data as $item) {
			$tag = "<button class=\"slave_name\" val=\"". $item->id. "\">". $item->nickname. "</button><br/>";
			echo $tag;
		}
	 ?>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".slave_name").click(function(){
				var link = "http://www.hereprovides.com/slave/index.php/Owner/suspect/" + $(this).attr("val");
				$.ajax({
					type: "get",
					url: link,
					dataType: "text",
					success: function(data){
						alert(data);
					}
				});
			});
		});
	</script>
</body>
</html>