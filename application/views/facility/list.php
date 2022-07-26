<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="<?= base_url() ?>facility/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Facilities</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> Facility Type </th>
				    <th> Min ID </th>
				    <th> Max ID </th>
				    <th> Quantity </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if(isset($facilities) && is_array($facilities)){
					foreach ($facilities as $rm) {
						// $emp->username
				?>
				  <tr>
				    <td> <?=$rm->facility_type ?> </td>
				    <td> <?=$rm->min_id ?> </td>
				    <td> <?=$rm->max_id?> </td>
				    <td> <?=($rm->max_id-$rm->min_id+1) ?> </td>
				    <td class="td-actions">
				    	<a href="<?= base_url() ?>facility/edit/<?=$rm->facility_type?>/<?=$rm->min_id?>/<?=$rm->max_id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
				    	<a href="<?= base_url() ?>facility/delete/<?=$rm->min_id?>/<?=$rm->max_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
				    </td>
				  </tr>
				<?php }} ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>