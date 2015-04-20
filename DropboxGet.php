<?php 
	$htmlContent = file_get_contents(/* 'Your Link Here' */); // Dropbox photo album share link
	$i = 0; $j = 0; $k = 0; $linkArr = Array();
	while (strpos($htmlContent, '<a href="https://www.dropbox', $i)) {
		$i = strpos($htmlContent, '<a href="https://www.dropbox', $i);
		$j = strpos($htmlContent, '"', $i + 10);
		$temp = substr($htmlContent, $i + 9, ($j - $i) - 9);
		$uni = true;
		if (!empty($linkArr)){
			foreach ($linkArr as $x) {
				if ($x == $temp)
					$uni = false;
			}
		}
		if ($uni) {
			$linkArr[$k] = $temp;
			$k++;
		}
		$i = $i + ($j - $i);
	}
	$i = 0; $j = 0; $k = 0; $picArr = Array();
	while (strpos($htmlContent, 'img data-src="', $i)) {
		$i = strpos($htmlContent, 'img data-src="', $i);
		$j = strpos($htmlContent, '"', ($i + 15));
		$temp = substr($htmlContent, ($i + 14), ($j - $i) - 14);
		$uni = true;
		if (!empty($picArr)){
			foreach ($picArr as $x) {
				if ($x == $temp)
					$uni = false;
			}
		}
		if ($uni) {
			$picArr[$k] = $temp;
			$k++;
		}
		$i = $i + ($j - $i);
	}
	for ($i = 0; $i < count($linkArr); $i++) {
		echo "<div style='float:left; padding:2px;'><a href=".$linkArr[$i]." target='_blank'><img src=".$picArr[$i]."></a></div>";
	}
?>
