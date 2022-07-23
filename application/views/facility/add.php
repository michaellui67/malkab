<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="<?= base_url() ?>facility/add" method="post">
		
			<h1>Add facilities</h1>		
<?php if(isset($error)) {?>
			<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> <?=$error?>
            </div>
<?php } ?>

			<div class="add-fields">

				<div class="field">
					<label for="facility_range">facility Type:</label>
					<select id="facility_type" name="facility_type">
					<?php
						foreach ($facility_types as $k=>$rt) {
							?>
							<option value="<?=$rt->facility_type?>" <?php if($k==0) { echo "selected"; } ?>><?=$rt->facility_type?></option>
							<?php
						}
					?>
					</select>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="min_id">ID range start:</label>
					<input type="number" min="1" id="min_id" name="min_id" required value="" placeholder="-"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="max_id">ID range end:</label>
					<input type="number" min="1" id="max_id" name="max_id" value="" placeholder="-"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Add</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>