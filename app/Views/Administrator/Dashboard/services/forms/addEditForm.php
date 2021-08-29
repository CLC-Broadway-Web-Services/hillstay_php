<?= $this->extend('Administrator/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Container START -->
<input id="form_id" value="<?= $formData['form_id'] ?>" hidden>
<div class="nk-content-wrap">
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <div class="card card-bordered card-full">
                    <div class="nk-wg1">
                        <div class="card-inner">
                            <div class="card-head">
                                <h5 class="card-title">
                                    <?php if ($formData['form_id'] == 0) {
                                        echo 'Add Form';
                                    } else {
                                        echo 'Edit Form';
                                    } ?>
                                </h5>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Service, Which the form displayed</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" name="service_id" id="service_id" required>
                                                <option <?php if ($formData['service_id'] == 0) echo 'selected' ?> disabled value="">Select Service</option>
                                                <?php foreach ($allServices as $service) : ?>
                                                    <option <?php if ($service['service_id'] == $formData['service_id']) echo 'selected' ?> value="<?= $service['service_id'] ?>"><?= $service['service_title'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Form Heading</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="form_heading" id="form_heading" class="form-control" placeholder="Form Heading" value="<?= $formData['form_heading'] ?>" required>
                                            <textarea name="form_fields" id="form_fields" hidden><?= json_encode($formData['form_fields'], true) ?></textarea>
                                            <div class="example-alert mt-2" id="form_heading_alert" hidden>
                                                <div class="alert alert-danger alert-icon alert-dismissible">
                                                    <em class="icon ni ni-cross-circle"></em> <b> Warning - </b> Form name required for future references. <button class="close" data-dismiss="alert"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Form Sorting Number</label>
                                        <div class="form-control-wrap">
                                            <input type="number" min="0" name="sort_number" id="sort_number" class="form-control" placeholder="Sort Number" value="<?= $formData['sort_number'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Form Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select" name="form_status" id="form_status" required>
                                                <option <?php if ($formData['form_status'] == 1) echo 'selected' ?> value="1">Active</option>
                                                <option <?php if ($formData['form_status'] == 0) echo 'selected' ?> value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($errorMessage)) : ?>
                                    <div class="alert alert-icon alert-danger" role="alert">
                                        <em class="icon ni ni-alert-circle"></em>
                                        <strong>Failed.</strong> <?= $errorMessage ?>
                                    </div>
                                <?php endif ?>
                                <div class="example-alert mb-2" id="no_fields_alert" hidden>
                                    <div class="alert alert-danger alert-icon alert-dismissible">
                                        <em class="icon ni ni-cross-circle"></em> <b> Warning - </b> There is no fields in this form, please add some fields before saving. <button class="close" data-dismiss="alert"></button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <form class="card" id="addmissionFieldsForm">
                                                <div class="card-header">
                                                    <h4 class="card-title">Add Fields</h4>
                                                </div>
                                                <div class="card-body ">
                                                    <div class="form-group">
                                                        <select class="custom-select" name="field_type" id="field_type" onchange="selectElementType(this)" required>
                                                            <option selected disabled>Select Field Type</option>
                                                            <option value="input">Single Line Input</option>
                                                            <option value="select">Select Menu</option>
                                                            <option value="textarea">Multi Line Input / Area</option>
                                                            <!-- <option value="file">File Uploading</option> -->
                                                        </select>
                                                    </div>
                                                    <div id="hiddenFormOptions">

                                                        <div id="commonFields" hidden>
                                                            <div class="form-group">
                                                                <label for="field_name" class="form-label">Field Name</label>
                                                                <input class="form-control" name="field_name" id="field_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="checkbox" name="required_field" id="required_field" value=true> Is this field Required!
                                                                        <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="inputFieldData" hidden>
                                                            <div class="form-group">
                                                                <select class="custom-select" name="input_type" id="input_type" onchange="selectInputType(this)" required>
                                                                    <option selected disabled>Input Type</option>
                                                                    <option value="text">Text</option>
                                                                    <option value="number">Number</option>
                                                                    <option value="email">Email</option>
                                                                    <option value="tel">Mobile / Phone</option>
                                                                    <option value="checkbox">Checkbox</option>
                                                                    <option value="date">Date</option>
                                                                    <option value="file">File Upload</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="inputMaxLength" hidden>
                                                            <label for="maxlength" class="form-label">Max Length</label>
                                                            <input class="form-control" type="number" name="maxlength" id="maxlength">
                                                        </div>
                                                        <div class="form-group" id="inputMinLength" hidden>
                                                            <label for="minlength" class="form-label">Min Length</label>
                                                            <input class="form-control" type="number" name="minlength" id="minlength" min=1>
                                                        </div>
                                                        <div class="form-group" id="inputMaxValue" hidden>
                                                            <label for="maxValue" class="form-label">Max Value</label>
                                                            <input class="form-control" type="number" name="maxValue" id="maxValue">
                                                        </div>
                                                        <div class="form-group" id="inputMinValue" hidden>
                                                            <label for="minValue" class="form-label">Min Value</label>
                                                            <input class="form-control" type="number" name="minValue" id="minValue" min=1>
                                                        </div>
                                                        <div class="form-group" id="inputMaxSize" hidden>
                                                            <label for="maxSize" class="form-label">Max Size (in MB)</label>
                                                            <input class="form-control" type="number" name="maxSize" id="maxSize">
                                                        </div>

                                                        <div class="mb-3" id="selectOptionsButton" hidden>
                                                            Add Options <button id="addSelectoptionButton" type="button" class="btn btn-success btn-sm float-right" onclick="addSelectOption()"><i class="material-icons">add</i></button>
                                                        </div>

                                                        <div id="selectFieldData" hidden></div>

                                                    </div>
                                                </div>
                                                <div class="card-footer ">
                                                    <button type="submit" class="btn btn-sm btn-primary" id="fieldAddButton">Add Field</button>
                                                    <button type="button" class="btn btn-sm btn-primary" id="fieldEditButton" onclick="updateThisField()" hidden>Update Field</button>
                                                    <!-- <button type="button" class="btn btn-sm btn-danger float-right" id="fieldResetButton" onclick="fieldAddingFormReset()">Reset Field Form</button> -->
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <form class="card" id="addmissionFormEdited">
                                                <div class="card-body" id="addmissionFormGroup" style="padding-top: 0; padding-bottom: 0;">
                                                    <?php if (!empty($formData['form_fields'])) { ?>
                                                        <?php foreach ($formData['form_fields'] as $key => $inputs) { ?>
                                                            <div class="json-data <?= $inputs->field_name; ?>" id="<?= $inputs->field_name; ?>" json-data='<?= json_encode($inputs) ?>'>
                                                                <?php if ($inputs->input_type == "text") { ?>
                                                                    <label for="<?= $inputs->field_name; ?>" class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="text" class="form-control" id="<?= $inputs->field_name; ?>" maxlength="<?= $inputs->maxlength; ?>" minlength="<?= $inputs->minlength; ?>" required="<?= $inputs->required; ?>">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "email") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="email" class="form-control" id="<?= $inputs->field_name; ?>" required="<?= $inputs->required; ?>">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "number") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="number" class="form-control" id="<?= $inputs->field_name; ?>" required="<?= $inputs->required; ?>" maxlength="<?= $inputs->maxlength; ?>" minlength="<?= $inputs->minlength; ?>" max="<?= $inputs->max; ?>" min="<?= $inputs->min; ?>">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "tel") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="tel" class="form-control" id="<?= $inputs->field_name; ?>" required="<?= $inputs->required; ?>">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "date") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="date" class="form-control" id="<?= $inputs->field_name; ?>" required="<?= $inputs->required; ?>" value="">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "checkbox") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input type="checkbox" class="form-check-input" id="<?= $inputs->field_name; ?>" required="<?= $inputs->required; ?>" value="">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "file") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <input style="padding: 17px 5px 0 0;" class="form-control-file" id="<?= $inputs->field_name; ?>" type="file" required="<?= $inputs->required; ?>">
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "select") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <select class="form-control" required="<?= $inputs->required; ?>">
                                                                        <option disabled selected>Select</option>
                                                                        <?php foreach ($inputs->options as $option) { ?>
                                                                            <option value="<?= $option; ?>"><?= $option; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                                <?php if ($inputs->input_type == "textarea") { ?>
                                                                    <label class="form-label"><?= $inputs->label; ?></label>
                                                                    <textarea class="form-control" id="<?= $inputs->field_name; ?>" type="file" required="<?= $inputs->required; ?>"></textarea>
                                                                    <small class="removeFieldForm" id="<?= $key + 1; ?>" style="cursor:pointer;"><strong>Remove</strong></small>
                                                                    <small class="editThisField" id="<?= $key + 1; ?>" style="cursor:pointer;float: right;"><strong> Edit</strong></small>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                            <!--  end card  -->
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="form-group">
                                        <button type="button" class="btn btn-dim btn-sm btn-primary" onclick="saveForm()">
                                            <?php if ($formData['form_id'] == 0) {
                                                echo 'Add Form';
                                            } else {
                                                echo 'Update Form';
                                            } ?>
                                        </button>
                                        <button type="button" class="btn btn-dim btn-sm btn-danger float-right" onclick="admFormReset()">
                                            Reset Form
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Page Container END -->
<?= $this->endSection() ?>