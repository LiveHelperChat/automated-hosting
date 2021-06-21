<form action="<?php echo $input->form_action?>" method="get" name="SearchFormRight" ng-non-bindable>

	<input type="hidden" name="doSearch" value="1">

	<div class="row">
		<div class="col-md-3">
		   <div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Address');?></label>
			<input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($input->address)?>" />
		   </div>
		</div>				
	</div>

	<div class="btn-group" role="group" aria-label="...">
		<input type="submit" name="doSearch" class="btn btn-secondary" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Search');?>" />	
	</div>

</form>
