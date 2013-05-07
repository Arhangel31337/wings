<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script type="text/javascript">$('body').mouse || document.write('<script src="/js/jquery-ui.min.js"><\/script>')</script>
	<script async type="text/javascript" src="/js/main.js"></script>
	
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