<section class="table">
	<ul>
		<li>
			<input action="add" type="button" value="Добавить" />
		</li>
		<li>
			<input action="remove" type="button" value="Удалить" />
		</li>
	</ul>
	<div class="cl-b"></div>
	<table>
		<thead>
			<tr>
				<th colspan="{count($list.columns) + 1}">{$list.name}</th>
			</tr>
			<tr>
				<th style="text-align: center;">
					<input type="checkbox" />
				</th>
{foreach from=$list.columns item=column}
	{if isset($column.table) && $column.table === false}{continue}{/if}
				<th>{$column.name}</th>
{/foreach}
			</tr>
		</thead>
		<tbody>
{if !empty($list.items)}
	{foreach from=$list.items key=key item=item}
			<tr class="first">
				<td style="text-align: center;">
					<input type="checkbox" elementID="{$item.id}" />
				</td>
		{foreach from=$list.columns key=key item=column}
				<td
			{if isset($column.style)}
					style="
				{if isset($column.style.align)}text-align: {$column.style.align};{/if}
				{if isset($column.style.main)}width: 100%;{/if}
				{if isset($column.style.nowrap)}white-space: nowrap;{/if}"
			{/if}
				>
			{if isset($column.link) && $column.link === true}
					<a href="{$item.id}/item/">{$item.{$key}}</a>
			{else}
				{if $column.field.type === 'checkbox'}
					{if $item.{$key}}Да{else}Нет{/if}
				{else}
					{$item.{$key}}
				{/if}
			{/if}
				</td>
		{/foreach}
			</tr>
	{/foreach}
{/if}
		</tbody>
	</table>
	<ul>
		<li>
			<input action="add" type="button" value="Добавить" />
		</li>
		<li>
			<input action="remove" type="button" value="Удалить" />
		</li>
	</ul>
	<div class="cl-b"></div>
</section>