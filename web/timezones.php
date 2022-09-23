<?php
// echo json_encode(DateTimeZone::listIdentifiers());
?>

<label>Time Zone</label>
<select>
	<?php foreach (DateTimeZone::listIdentifiers() as $id): ?>
		<option name="localeId"><?php echo $id; ?></option>
	<?php endforeach; ?>
</select>
