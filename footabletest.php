<?php
require_once 'core/init.php';
include 'scripts.php'; ?> 

<table class="table table-hover footable">
<thead>
	<tr>
		<th>first name</th>
		<th>last name</th>
		<th data-hide='phone,tablet'>date</th>
		<th data-hide='phone'>status</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>Alex</td>
		<td>Thomas</td>
		<td>4/5/06</td>
		<td class="success bg-success">Active</td>
	</tr>
	<tr>
		<td>Tammy</td>
		<td>Bernard</td>
		<td>7/14/98</td>
		<td class="warning">Busy</td>
	</tr>
	<tr>
		<td>Santhosh</td>
		<td>Venugopal</td>
		<td>3/8/04</td>
		<td class="muted">Idle</td>
	</tr>
	<tr>
		<td>Garfield</td>
		<td>Cousins</td>
		<td>6/28/13</td>
		<td class="danger">Inactive</td>
	</tr>
</tbody>
</table>

<script>
$('table').footable();
</script>