<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>slave game</title>
</head>
<body>
	<h1><?php echo $nickname. " " ?>in slave game</h1>
	<hr>
	<h2>朕的奴隶</h2>
		<?php
			foreach ($data->owner_record as $item) {
				$tag = "<a href='http://www.hereprovides.com/slave/index.php/User/state/".$item->id."'>".$item->nickname."</a><br/>";
				echo $tag;
			}
		?>
	<hr>
	<h2>我的主人</h2>
		<?php
			foreach ($data->slave_record as $item) {
				$tag = "<a href='http://www.hereprovides.com/slave/index.php/User/state/".$item->id."'>".$item->nickname."</a><br/>";
				echo $tag;
			}
		?>
	<hr>
	<h2>平定叛乱</h2>
		<?php 
			echo json_encode($data->handle_count). '次';
		?>
	<hr>
	<h2>推翻暴政</h2>
		<?php 
			echo json_encode($data->raise_count). '次';
		?>
	<hr>

	<a href="http://www.hereprovides.com/slave/index.php/Player/enter">join game</a>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">

	</script>
</body>
</html>