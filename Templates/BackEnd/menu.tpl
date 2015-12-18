			<ul>
{foreach from=$nodes item=node}
				<li>
					<a class="icon {$node.alias}" href="#" page="1;{$node.alias};list">{$node.name}</a>
	{if isset($node.childrens)}
		{include file="menu.tpl" nodes=$node.childrens}
	{/if}
				</li>
{/foreach}
			</ul>
