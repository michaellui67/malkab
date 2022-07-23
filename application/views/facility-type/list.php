<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<a href="<?= base_url() ?>facility-type/add" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add facility Type</a>
			<br><br>
			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> facility Type </th>
				    <th> Price </th>
				    <th> Details </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if(isset($facility_types) && is_array($facility_types)):
					foreach ($facility_types as $rt) {
				?>
				  <tr>
				    <td> <?=$rt->facility_type ?> </td>
				    <td> <?=$rt->facility_price ?>$ </td>
				    <td> <?=$rt->facility_details ?> </td>
				    <td class="td-actions">
				    	<a href="<?= base_url() ?>facility_type/edit/<?=$rt->facility_type?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
				    	<a href="<?= base_url() ?>facility_type/delete/<?=$rt->facility_type?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
				    </td>
				  </tr>
				<?php } ?>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
  </div>
</div>