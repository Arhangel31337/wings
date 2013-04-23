<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>WingsLog</title>
	<script type="text/javascript" src="<?php echo $thisDir; ?>sh/scripts/shCore.js"></script>
	<script type="text/javascript" src="<?php echo $thisDir; ?>sh/scripts/shBrushPhp.js"></script>
	<link href="<?php echo $thisDir; ?>sh/styles/shCore.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $thisDir; ?>sh/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		SyntaxHighlighter.all();
	</script>
    <style type="text/css">
/* reset */

body, html, * { padding: 0; margin: 0; font-size: 1em; outline: none; }
a img, iframe, fieldset, object { border: none; }
caption, th { text-align: left; }
td { vertical-align: top; }
sub, sup { vertical-align: baseline; }
ul { list-style-type: none; }
table { border-collapse: collapse; border-spacing: 0; }
body { background-color: white; }
th, h1, h2, h3, h4, h5, h6 { font-weight: normal; }
cite, em { font-style: normal; }

/* style */

body {
	background: url("<?php echo $thisDir; ?>images/golub18.gif") repeat scroll center top transparent;
}

body .wrapper {
	background-color: #fffafa;
	border: 4px solid #eaebeb;
	color: #000000;
	font-family: Arial;
	font-size: 14px;
	margin: 30px 50px;
	padding: 12px;
}

h1 {
	color: #739fb1;
	font-size: 22px;
	text-transform: uppercase;
}

h2 {
	color: #739fb1;
	font-size: 14px;
	text-transform: uppercase;
}

hr {
	margin-bottom: 15px; 
}

p {
	margin-bottom: 15px;
}

p.filePath {
	color: #858386;
}
	</style>
</head>
<body>
	<div class="wrapper">
		<h1>PHP <?php echo self::$errorName[self::$errorNumber]; ?></h1>
		<hr color="#D7DFDF" size="1" noshade />
		<p>An error encountered in <?php echo self::$errorFile; ?> on line <?php echo self::$errorLine; ?></p>
		<h2>Error message</h2>
		<hr color="#D7DFDF" size="1" noshade />
		<p><?php echo self::$errorMessage; ?></p>
		<h2>Stack</h2>
		<hr color="#D7DFDF" size="1" noshade />
<?php 
if (!empty(self::$errorTrace) && self::$errorTrace[0]['function'] != 'RegisterShutdownFunction') {
foreach (self::$errorTrace as $key => $value) {?>
		<p class="filePath"><?php echo $value['file'];?></p>
		<pre class="brush: php; first-line: <?php echo $value['line'];?>;"><?php echo self::GetStringInFile($value['file'], $value['line']); ?></pre>
<?php } ?>
<?php
if (isset($value['args']) && !empty($value['args'])) { ?>
		<pre class="brush: php;"><?php foreach ($value['args'] as $key2 => $value2) { print_r($value2); } ?></pre>
<?php } }
else { ?>
		<p class="filePath"><?php echo self::$errorFile;?></p>
		<pre class="brush: php; first-line: <?php echo self::$errorLine;?>;"><?php echo self::GetStringInFile(self::$errorFile, self::$errorLine); ?></pre>
<?php } ?>
	</div>
</body>
</html>