<section class="table">
	<ul style="float: left;">
		<li>
			<input action="prev" type="button" value="Назад" />
		</li>
	</ul>
	<ul>
		<li>
			<input action="change" type="button" value="Изменить" />
		</li>
		<li>
			<input action="remove" type="button" value="Удалить" />
		</li>
	</ul>
	<div class="cl-b"></div>
	<table>
		<thead>
			<tr>
				<th colspan="{count($element.columns)}">{$element.name}</th>
			</tr>
		</thead>
		<tbody>
{foreach from=$element.columns key=key item=column}
			<tr class="{if ($key % 2)}first{else}second{/if}">
				<td class="ta-r" nowrap>{$column.name}</td>
				<td>
		{if $column.field.type === 'checkbox'}
			{if $element.item.{$key}}Да{else}Нет{/if}
		{else}
			{if is_array($element.item.{$key})}
				{foreach from=$element.item.{$key} item=item}
					{if $item.selected}
					<p>{$item.name}</p>
					{/if}
				{/foreach}
			{else}
				{$element.item.{$key}}
			{/if}
		{/if}
				</td>
			</tr>
{/foreach}
		</tbody>
	</table>
	<ul style="float: left;">
		<li>
			<input action="prev" type="button" value="Назад" />
		</li>
	</ul>
	<ul>
		<li>
			<input action="change" type="button" value="Изменить" />
		</li>
		<li>
			<input action="remove" type="button" value="Удалить" />
		</li>
	</ul>
	<div class="cl-b"></div>
</section>