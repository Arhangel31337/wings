<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script src="/js/main.js"></script>
	
    <title>Arhangel31337</title>
</head>
<body>
{if isset($contentTPL)}
{include file=$contentTPL}
{elseif isset($content)}
{$content}
{/if}
</body>
</html>