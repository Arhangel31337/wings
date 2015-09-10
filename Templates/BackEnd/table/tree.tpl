<section class="table">
	<ul>
		<li>
			<input action="add" type="button" value="Добавить" />
		</li>
	</ul>
	<div class="cl-b"></div>
	<table class="sortable">
		<thead>
			<tr>
				<th colspan="1">{$tree.name}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<ul>
{if !empty($tree.items)}
	{foreach from=$tree.items item=item}
		{include file='table/treeRow.tpl' level=0 columns=$tree.columns item=$item}
	{/foreach}
{/if}
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	<ul>
		<li>
			<input action="add" type="button" value="Добавить" />
		</li>
	</ul>
	<div class="cl-b"></div>
</section>