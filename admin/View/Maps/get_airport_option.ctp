<option value="">--- Select Country ---</option>

<?php foreach ($airports as $_id => $_name) { ?>
	<?php
	if ($_id == $airport_id) {
		$selected = ' selected="selected"';
	} else {
		$selected = '';
	}
	?>
	<option value="<?php echo $_id; ?>"<?php echo $selected; ?>><?php echo $_name; ?></option>
<?php } ?>
