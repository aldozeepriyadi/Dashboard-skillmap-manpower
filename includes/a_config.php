<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/kyb-skill-map-man-power/index.php":
			$CURRENT_PAGE = "Dashboard"; 
			$PAGE_TITLE = "Skill Map Man Power Dashboard";
			break;
			default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Welcome to my homepage!";
		}
	$PAGE_TITLE = "Skill Map Man Power Dashboard";
	$members_per_pages = 4;
	$mp_categories = array(
		"msk"=>"MSK",
		"kt"=>"KT",
        "pssp"=>"PSSP",
        "png"=>"PNG",
        "fivejq"=>"5JQ",
        "kao"=>"KAO"
	);
?>