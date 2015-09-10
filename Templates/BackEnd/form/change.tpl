<section class="form">
	<ul>
		<li>
			<input action="prev" type="button" value="Назад" />
		</li>
		<li>
			<input action="change" type="button" value="Изменить" />
		</li>
	</ul>
	<div class="cl-b"></div>
	<aside>
		<div class="arrow"></div>
		<div class="wrapper">
			<div class="info">
				<div class="error">
					<div class="image"></div>
					<div class="text">text text text text text text text text text text</div>
				</div>
				<div class="description">
					<div class="image"></div>
					<div class="text">text text text text text text text text text text</div>
				</div>
			</div>
		</div>
	</aside>
	<form action="" method="POST" enctype="{$formEnctype}">
		<table>
			<thead></thead>
			<tbody>
	{foreach from=$element.columns key=key item=column}
		{if !isset($column.generated) || $column.generated === false}
				<tr>
					<td class="ta-r">{$column.name}{if isset($column.validate)}<span>*</span>{/if}:</td>
					<td>
						{include file='form/items/'|cat:$column.field.type|cat:'.tpl' key=$key field=$column}
					</td>
				</tr>
		{else}
			{include file='form/items/hidden.tpl' field=$column}
		{/if}
	{/foreach}
			</tbody>
		</table>
	</form>
	<ul>
		<li>
			<input action="prev" type="button" value="Назад" />
		</li>
		<li>
			<input action="change" type="button" value="Изменить" />
		</li>
	</ul>
	<div class="cl-b"></div>
</section>