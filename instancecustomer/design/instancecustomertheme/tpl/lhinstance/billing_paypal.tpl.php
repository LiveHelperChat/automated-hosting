<?php if (erConfigClassLhConfig::getInstance()->getSetting('site','seller_paypal_enabled') == true) : ?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="MCCCZQSD6V6UQ">
	<div class="row">	
		<div class="col-sm-6">
			<table>
			<tr>
				<td>
					<input type="hidden" name="on0" value="Request quantity, (1 month extend)"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request quantity, (includes 1 month extend)')?></td></tr>
			<tr>
			     <td>
			         <select class="form-control" name="os0">
						<option value="250K">250K €3.00 EUR</option>
						<option value="1.5M">1.5M €6.00 EUR</option>
						<option value="3M">3M €9.00 EUR</option>
					</select>
				</td>
			</tr>
			</table>
		</div>
		<div class="col-sm-6">
			<input type="hidden" name="custom" value="<?php echo $instance->id?>">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</div>	
	</div>
</form>
<?php endif; ?>