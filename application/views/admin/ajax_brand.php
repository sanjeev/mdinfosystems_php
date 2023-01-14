<option value="">Select Model</option>
<?php
foreach($brand as $result)
      {
		?>
		<option value="<?php echo $result->id; ?>"> <?php echo $result->name; ?></option>

<?php } ?>
