<?php error_reporting(0);?>
<?php if(count($errors)>0):?>
	<center><p style="color:white;background:red;padding: 8px;width: 100px;border-radius: 10px;margin-bottom: -7px;font-size: 20px;"><b>Errors</b></p></center>
<div id="error_bord">
		<?php foreach ($errors as $error):?>
			<p style="color: white;font-family: 'Chicle', cursive;
"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif?>
