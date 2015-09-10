		{foreach from=$columns key=key item=column}
			{if isset($column.link) && $column.link === true}
				<li element="{$item.id}" style="padding-left: 20px;">
					<div class="drag" style="margin-left: {(-20 * $level - 17)}px;"></div>
					<a href="{$item.id}/item/">{$item.{$key}}</a>
					<ul>
				{if isset($item.childrens)}
					{foreach from=$item.childrens item=children}
						{include file='table/treeRow.tpl' level={$level + 1} columns=$columns item=$children}
					{/foreach}
				{/if}
					</ul>
			{/if}
				</li>
		{/foreach}
