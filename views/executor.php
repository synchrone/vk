<?php

if(isset($out) && $out!=''){ ?>
    <h2>Code output</h2>
    <pre><?=$out?></pre>
    <br /><br />
<?php } ?>



<form action="" method="post">
	Configuration: <select name="configuration">
		<?php
			foreach($configurations as $cfg){
				printf("<option %s>%s</option>",$selected_cfg == $cfg ? 'selected' : '', $cfg);
			}
	  	?>
	</select>
	<br />
    <textarea name="code" rows="20" cols="120"><?=$code?>
</textarea>
    <br />
    <input type="submit" value="Execute!">
</form>