<option value="">Select Model</option>
<?php
foreach($model as $result)
      {
		?>
		<option value="<?php echo $result->id; ?>"> <?php echo $result->name; ?></option>

<?php } ?>
