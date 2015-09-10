<select class="pseudo-select" name="{$key}">
{if isset($field.value)}
	{include file='form/items/selectItem.tpl' els=$field.value multi=false}
{/if}
</select>