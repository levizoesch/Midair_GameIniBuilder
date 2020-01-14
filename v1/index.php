<?php
/* Required */
require('settings/core/config/constants.php');
require('settings/core/class/FormFields.php');
require('settings/core/class/gameBuilder.php');
require('settings/core/class/gameIni.php');


$html = NULL;

$gameBuildr = new gameBuilder();

if (!empty($_POST)) {
	$html = $gameBuildr->buildPage($gameBuildr->html_resultsMarkup());
} else {
	$html = $gameBuildr->buildPage($gameBuildr->html_buildMarkup());
}

echo $html;
