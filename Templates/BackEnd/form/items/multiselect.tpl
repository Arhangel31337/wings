<select class="multi other" multiple size="10">
{include file='form/items/selectItem.tpl' els=$field.value multi=true selected=false}
</select>
<div class="arrows">
	<div class="arrow right"></div>
	<div class="arrow left"></div>
	<div class="d-n" name="{$key}">
{foreach from=$field.value item=el}
	{if $el.selected}
		<input type="hidden" name="{$key}[{$el.id}]" value="{$el.id}"/>
	{/if}
{/foreach}
	</div>
</div>
<select class="multi selected" name="{$key}[]"  multiple size="10">
{include file='form/items/selectItem.tpl' els=$field.value multi=true selected=true}
</select>
<div class="cl-b"></div>