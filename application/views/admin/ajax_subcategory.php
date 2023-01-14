<option value="">Select Subcategory</option>
<?php
foreach($sub_category as $result)
      {
		?>
		<option value="<?php echo $result->id; ?>"> <?php echo $result->name; ?></option>

<?php } ?>
