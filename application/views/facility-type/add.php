<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="<?= base_url() ?>facility-type/add" method="post">
		
			<h1>Add facility Type</h1>		
<?php if(isset($error)) {?>
			<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Error!</strong> <?=$error?>
            </div>
<?php } ?>
			<div class="add-fields">

				<div class="field">
					<label for="facility_type">facility Type:</label>
					<input type="text" id="type" name="type" required value="" placeholder="facility Type"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="facility_price">Price:</label>
					<input type="number" min="1" id="price" name="price" required value="" placeholder="Price"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="facility_details">Details:</label>
					<input type="text" id="details" name="details" value="" placeholder="Details of facility"/>
				</div> <!-- /field -->

				<!--div class="field">
					<label for="facility_quantity">Quantity:</label>
					<input type="number" min="1" id="quantity" name="quantity" value="" placeholder="Quantity"/>
				</div--> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Add</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>