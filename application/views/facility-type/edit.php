<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="<?= base_url() ?>facility_type/edit/<?=$facility_type->facility_type?>" method="post">
		
			<h1>Update facility Type</h1>		
			
			<div class="add-fields">

				<div class="field">
					<label for="facility_type">facility Type:</label>
					<input type="text" id="type" name="type" required value="<?=$facility_type->facility_type?>" placeholder="facility Type" readonly/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="facility_price">Price:</label>
					<input type="number" min="1" id="price" name="price" required value="<?=$facility_type->facility_price?>" placeholder="Price"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="facility_details">Details:</label>
					<input type="text" id="details" name="details" value="<?=$facility_type->facility_details?>" placeholder="Details of facility"/>
				</div> <!-- /field -->

				<!--div class="field">
					<label for="facility_quantity">Quantity:</label>
					<input type="number" min="1" id="quantity" name="quantity" value="<?=$facility_type->facility_quantity?>" placeholder="Quantity"/>
				</div--> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>
