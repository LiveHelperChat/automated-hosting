<div class="row" ng-non-bindable>
    <div class="col-6">
        <div class="form-group">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Name');?></label>
            <input type="text" class="form-control" name="ClientData[name]"  value="<?php echo htmlspecialchars(isset($instance->client_attributes_array['name']) ? $instance->client_attributes_array['name'] : '');?>" />
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Surname');?></label>
            <input type="text" class="form-control" name="ClientData[surname]"  value="<?php echo htmlspecialchars(isset($instance->client_attributes_array['surname']) ? $instance->client_attributes_array['surname'] : '');?>" />
        </div>
    </div>
</div>


