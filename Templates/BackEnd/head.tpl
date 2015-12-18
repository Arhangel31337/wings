<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="{$charset}" />
	
	<meta name="viewport" content="width=1040px">
	
{if isset($meta)}
	{foreach from=$meta.httpEquiv key=key item=value}
<meta http-equiv="{$key}" content="{$value}" />
	{/foreach}
	
	{foreach from=$meta.name key=key item=value}
<meta name="{$key}" content="{$value}" />
	{/foreach}
{/if}
	
{if isset($page.pageDescription)}
	<meta name="Description" content="{$page.pageDescription}" />
{/if}
{if isset($page.documentState)}
	<meta name="Document-state" content="{$page.documentState}" />
{/if}
{if isset($page.pageKeywords)}
	<meta name="Keywords" content="{$page.pageKeywords}" />
{/if}
{if isset($page.resourceType)}
	<meta name="Resource-type" content="{$page.resourceType}" />
{/if}
{if isset($page.revisit)}
	<meta name="Revisit" content="{$page.revisit}" />
{/if}
{if isset($page.robots)}
	<meta name="Robots" content="{$page.robots}" />
{/if}
	
    {if isset($page.pageTitle)}<title>{$page.pageTitle}</title>{/if}
	
	<link rel="stylesheet" type="text/css" href="/css/backend/reset.css" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:Regular,Medium" />
    <link rel="stylesheet" type="text/css" href="/css/backend/style.css" />
	
{foreach from=$files.css item=css}
	<link rel="stylesheet" type="text/css" href="{$css}" />
{/foreach}
<!--[if lt IE 9]>
	<script "text/javascript" src="/js/jquery.min.1.11.1.js"></script>
	<script src="/js/html5.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/css/style-ie7.css" />
<![endif]-->
{if !isset($isFullScreen) || !$isFullScreen}
<!--[if (gt IE 8)><!-->
	<script type="text/javascript" src="/js/jquery.min.js"></script>
<!--<![endif]-->
{/if}
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="/js/BackEnd/functions.js"></script>
	
{foreach from=$files.js item=js}
	<script {if $js.async}async {/if}type="text/javascript" src="{$js.src}"></script>
{/foreach}
	
</head>