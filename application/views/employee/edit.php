<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="<?= base_url() ?>employee/edit/<?=$employee->employee_id?>" method="post">
		
			<h1>Update Employee's Information</h1>		
			
			<div class="add-fields">

				<div class="field">
					<label for="employee_username">Username:</label>
					<input type="text" id="username" name="username" required value="<?=$employee->employee_username?>" placeholder="Username"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="text" id="password" name="password" required value="<?=$employee->employee_password?>" placeholder="Password"/>
				</div> <!-- /password -->

				<div class="field">
					<label for="employee_firstname">First name:</label>
					<input type="text" id="firstname" name="firstname" required value="<?=$employee->employee_firstname?>" placeholder="Firstname"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_lastname">Last name:</label>
					<input type="text" id="lastname" name="lastname" required value="<?=$employee->employee_lastname?>" placeholder="Lastname"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_telephone">Telephone:</label>
					<input type="text" id="telephone" name="telephone" value="<?=$employee->employee_telephone?>" placeholder="Telephone"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_email">Email:</label>
					<input type="text" id="email" name="email" required value="<?=$employee->employee_email?>" placeholder="Email"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>