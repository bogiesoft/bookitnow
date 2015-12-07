<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title_for_layout; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo @$this->layouts->print_includes()['css']; ?> 

</head>

<body>
	  <?php echo $content_for_layout; ?>

	<?php echo @$this->layouts->print_includes()['js']; ?> 
</body>
</html>