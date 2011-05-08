<?php

if(isset($out) && $out!=''){ ?>
    <h2>Code output</h2>
    <pre><?=$out?></pre>
    <br /><br />
<?php } ?>



<form action="" method="post">
    <textarea name="code" rows="20" cols="60"><?=$code?>
</textarea>
    <br />
    <input type="submit" value="Execute!">
</form>