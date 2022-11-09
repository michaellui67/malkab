<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">

		<form action="<?= base_url() ?>facility/edit/<?=$facility_range->facility_type?>/<?=$facility_range->min_id?>/<?=$facility_range->max_id?>" method="post">
		
			<h1>Update facilities</h1>		
<?php if(isset($error)) {?>
			<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> <?=$error?>
            </div>
<?php } ?>

			<div class="add-fields">

				<div class="field">
					<label for="facility_range">Facility Type:</label>
					<select id="facility_type" name="facility_type">
					<?php
						foreach ($facility_types as $rt) {
							?>
							<option value="<?=$rt->facility_type?>" <?php if($rt->facility_type==$facility_range->facility_type) { echo "selected"; } ?>><?=$rt->facility_type?></option>
							<?php
						}
					?>
					</select>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="min_id">ID range start:</label>
					<input type="number" min="1" id="min_id" name="min_id" required value="<?=$facility_range->min_id?>" placeholder="1"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="max_id">ID range end:</label>
					<input type="number" min="1" id="max_id" name="max_id" value="<?=$facility_range->max_id?>" placeholder="1"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>
