<!DOCTYPE html>
<html>
{include file="head.tpl"}
<body>
	<div class="loader-bg">
		<div class="loader"></div>
	</div>
	<div class="main">
		<header>
			<div class="menu">
				<div class="main-wrapper">
					<a href="/ru-ru/admin/">
						<div class="logo fl-l"></div>
					</a>
					<div class="fl-r">
						<form action="?logout" method="post">
							<input type="submit" name="logout" value="Выйти" placeholder="Выйти" tabindex="0" />
						</form>
					</div>
{if isset($navigation)}
					<nav>
						<ul>
	{foreach from=$navigation item=item}
							<li><a href="/{$language.code}/{$workspace.url}/{$item.url}" menu="{$item.alias}">{$item.name}</a></li>
	{/foreach}
						</ul>
					</nav>
{/if}
					<div class="cl-b"></div>
				</div>
			</div>
{if isset($navigation)}
			<div class="subMenu">
				<nav class="main-wrapper">
	{foreach from=$navigation item=item}
					<ul menu="{$item.alias}">
		{if isset($item.childrens)}
			{foreach from=$item.childrens item=subItem}
				{if isset($page.id) && $subItem.id === $page.id}
						<li class="active">{$subItem.name}</li>
				{else}
						<li><a href="/{$language.code}/{$workspace.url}/{$subItem.url}">{$subItem.name}</a></li>
				{/if}
			{/foreach}
		{/if}
					</ul>
	{/foreach}
					<div class="cl-b"></div>
				</nav>
			</div>
{/if}
		</header>
		<div>
			<div class="main-wrapper">
{if isset($breadcrumbs)}
				<div class="breadcrumbs">
	{foreach from=$breadcrumbs item=item}
					<a href="/{$language.code}/{$workspace.url}/{$item.url}">{$item.name}</a>
		{if !isset($page.id) || $item.id !== $page.id}
					<span>/</span>
		{/if}
	{/foreach}
				</div>
{/if}
				<div class="content">
{if isset($page.name)}
					<h1>{$page.name}</h1>
{/if}
{if isset($contentTPL)}
	{include file=$contentTPL}
{/if}
				</div>
			</div>
		</div>
		<footer>
			<div class="copyright">© 2015 Arhangel31337</div>
		</footer>
	</div>
</body>
</html>