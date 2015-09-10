{if $multi}
	{if isset($selected)}
		{foreach from=$els key=key item=el}
			{if $selected == $el.selected}
<option value="{$el.id}">{if isset($el.lang_name)}{$el.lang_name}{else}{$el.name}{/if}</option>
				{if isset($el.childrens)}
					{include file='form/items/selectItem.tpl' els=$el.childrens}
				{/if}
			{/if}
		{/foreach}
	{else}
		{foreach from=$els key=key item=el}
<option value="{$el.id}">{if isset($el.lang_name)}{$el.lang_name}{else}{$el.name}{/if}</option>
			{if isset($el.childrens)}
				{include file='form/items/selectItem.tpl' els=$el.childrens}
			{/if}
		{/foreach}
	{/if}
{else}
	{if isset($onlySelected)}
		{foreach from=$els key=key item=el}
			{if $selected == $el.selected}
<option value="{$el.id}"{if isset($el.level)} style="padding-left: {(($el.level - 1) * 10)}px"{/if}>{if isset($el.lang_name)}{$el.lang_name}{else}{$el.name}{/if}</option>
				{if isset($el.childrens)}
					{include file='form/items/selectItem.tpl' els=$el.childrens}
				{/if}
			{/if}
		{/foreach}
	{else}
		{foreach from=$els key=key item=el}
<option value="{$el.id}"{if isset($el.level)} style="padding-left: {(($el.level - 1) * 10)}px"{/if}>{if isset($el.lang_name)}{$el.lang_name}{else}{$el.name}{/if}</option>
			{if isset($el.childrens)}
				{include file='form/items/selectItem.tpl' els=$el.childrens}
			{/if}
		{/foreach}
	{/if}
{/if}