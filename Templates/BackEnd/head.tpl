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
	
{if isset($page.pageTitle)}
	<title>{$page.pageTitle}</title>
{/if}
	<link rel="icon" href="/images/backend/favicon.png" />
{if isset($files.css) && !empty($files.css)}	
	{foreach from=$files.css item=css}
<link rel="stylesheet" type="text/css" href="{$css}" />
	{/foreach}
{/if}
{if isset($files.js) && !empty($files.css)}	
	{foreach from=$files.js item=js}
<script type="text/javascript" src="{$js.src}"{if $js.async} async{/if}></script>
	{/foreach}
{/if}
	
</head>