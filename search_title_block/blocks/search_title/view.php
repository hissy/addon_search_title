<?php
defined('C5_EXECUTE') or die("Access Denied.");

if ($query || $dt || $optionQuery) :
	?>
	<h2>
	<?php
	$val = '';
	if ($query) {
		$val .= $query;
	}
	if ($dt) {
		$val .= $dt->format(t('F, Y'));
	}
	if (is_array($optionQuery) && count($optionQuery) > 0) {
		$val .= implode(', ', $optionQuery);
	}
	echo t('Search Results for: %s', h($val));
	?>
	</h2>
	<?php
endif;
