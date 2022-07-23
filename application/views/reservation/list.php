<style type="text/css">
	.table td{height: 50px; width: 50px;}
	.table{width: 0;}
	.table{margin: 0 auto;}
	.field{margin: 5px 10px; float: left;}
</style>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<form action="<?= base_url() ?>reservation/make" method="post">
			<div class="add-fields">

				<!--div class="field">
					<input type="hidden" id="customer_id" name="customer_id" required readonly value="<?=$customer_id?>"/>
				</div--> <!-- /field -->

				<div class="field">
					<label for="customer_id">Customer TC no:</label>
					<input type="text" id="customer_id" name="customer_id" required readonly value="<?=$customer_id?>"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="facility_type">facility Type:</label>
					<input type="text" id="facility_type" name="facility_type" required readonly value="<?=$facility_type?>"/>
				 </select>
				</div> <!-- /field -->

				<div class="field">
					<label for="checkin_date">Check-in Date:</label>
					<input type="date" id="checkin_date" name="checkin_date" required readonly value="<?=$checkin_date?>"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="checkout_date">Check-out Date:</label>
					<input type="date" id="checkout_date" name="checkout_date" required readonly value="<?=$checkout_date?>"/>
				</div> <!-- /field -->
			</div> <!-- /login-fields -->
				<div class="row">
					<div class="span12">
		<?php
			$size = count($facilities);
			$cols = ceil(sqrt($size));
			$rows = ceil($size/$cols);
		?>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th colspan="<?=$cols?>">Avaliable facilities</th>
							</tr>
						</thead>
						<tbody>
						<?php for ($t=0, $i=0; $t<$rows; ++$t) { ?>
							<tr>
								<?php for($j=0; $j<$cols && $i<$size; ++$i, ++$j) { ?>
								<td class="td-actions"><button name="facility_id" value="<?=$facilities[$i]->facility_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-small btn-primary"><?=$facilities[$i]->facility_id?><br><i class="btn-icon-only icon-edit"> </i></button></td>
							<?php } ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>