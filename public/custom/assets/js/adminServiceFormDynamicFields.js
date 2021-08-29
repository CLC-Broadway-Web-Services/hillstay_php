var currentPath = window.location.pathname;
var form_heading = $("#form_heading");
var form_fields = $("#form_fields");
var service_id = $("#service_id");
var form_id = $("#form_id");
var sort_number = $("#sort_number");
var form_status = $("#form_status");

const textMinLength = 1;
const textMaxLength = 2000;
const numberMinLength = 1;
const numberMaxLength = 100;
const fileMaxSize = 24000;

class InputText {
  input_type = "text";
  field_name = "";
  required = false;
  label = "";
  maxlength = textMaxLength;
  minlength = textMinLength;
  value = "";
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.maxlength = dynamicValues.maxlength || textMaxLength;
    this.minlength = dynamicValues.minlength || textMinLength;
    this.value = dynamicValues.value || "";
  }
}
class InputCheckbox {
  input_type = "cehckbox";
  field_name = "";
  required = false;
  label = "";
  value = false;
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.value = dynamicValues.value || false;
  }
}
class InputDate {
  input_type = "date";
  field_name = "";
  required = false;
  label = "";
  value = new Date();
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.value = dynamicValues.value || new Date();
  }
}
class InputEmail {
  input_type = "email";
  field_name = "";
  required = false;
  label = "";
  value = "";
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.value = dynamicValues.value || "";
  }
}
class InputNumber {
  input_type = "number";
  field_name = "";
  required = false;
  label = "";
  maxlength = numberMaxLength;
  minlength = numberMinLength;
  max = numberMaxLength;
  min = numberMinLength;
  value = 0;
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.maxlength = dynamicValues.maxlength || numberMaxLength;
    this.minlength = dynamicValues.minlength || numberMinLength;
    this.max = dynamicValues.max || numberMaxLength;
    this.min = dynamicValues.min || numberMinLength;
    this.value = dynamicValues.value || null;
  }
}
class InputTel {
  input_type = "tel";
  field_name = "";
  required = false;
  label = "";
  value = 0;
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.value = dynamicValues.value || 0;
  }
}
class InputFile {
  input_type = "file";
  field_name = "";
  required = false;
  label = "";
  maxsize = fileMaxSize;
  value = "";
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.maxsize = dynamicValues.maxsize || fileMaxSize;
    this.value = dynamicValues.value || "";
  }
}
class SelectField {
  input_type = "select";
  field_name = "";
  required = false;
  label = "";
  options = {};
  value = "";
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.options = dynamicValues.options || {};
    this.value = dynamicValues.value || "";
  }
}
class TextArea {
  input_type = "textarea";
  field_name = "";
  required = false;
  label = "";
  maxlength = 5000;
  minlength = 200;
  value = "";
  constructor(dynamicValues) {
    this.field_name = dynamicValues.field_name || "";
    this.required = dynamicValues.required || false;
    this.label = dynamicValues.label || "";
    this.maxlength = dynamicValues.maxlength || 5000;
    this.minlength = dynamicValues.minlength || 200;
    this.value = dynamicValues.value || "";
  }
}

var i = 0;
var f = 0;
var mode = null;
var mode_div_id = null;
var mode_index = null;

$(document).ready(function () {
  //   initializeTinyMce();
  // setTimeout(() => {
  //   console.log(inputText);
  // }, 1000);
  console.log(form_fields.val());
  if (form_id.val() > 0) {
    // dataObjectToUpload.push(JSON.parse(form_fields.val()));
    dataObjectToUpload = JSON.parse(form_fields.val());
  }
  if (mode == "edit") {
    document.getElementById("fieldEditButton").removeAttribute("hidden");
    document.getElementById("fieldAddButton").setAttribute("hidden", "hidden");
  } else {
    document.getElementById("fieldAddButton").removeAttribute("hidden");
    document.getElementById("fieldEditButton").setAttribute("hidden", "hidden");
  }
  // $('#addmissionFieldsForm').validate();
  // $('#addmissionFormEdited').validate();
  console.log(dataObjectToUpload);
});

var formPrefix = "adm_";
var inputFieldData = document.getElementById("inputFieldData");
var selectFieldData = document.getElementById("selectFieldData");
var selectOptionsButton = document.getElementById("selectOptionsButton");

function selectElementType(event) {
  document.getElementById("commonFields").removeAttribute("hidden");
  //   console.log(event.value);
  if (event.value == "input") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");

    onAllRemove();
    return;
  }
  if (event.value == "select") {
    inputFieldData.setAttribute("hidden", "hidden");
    selectFieldData.removeAttribute("hidden");
    selectOptionsButton.removeAttribute("hidden");
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    addSelectOption();
    return;
  }
  if (event.value == "textarea") {
    inputFieldData.setAttribute("hidden", "hidden");
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    maxMinLengthShow();
    maxMinHide();
    maxMinSizeHide();

    onAllRemove();
    return;
  }
}
function selectInputType(event) {
  document.getElementById("commonFields").removeAttribute("hidden");
  //   console.log(event.value);
  if (event.value == "text") {
    maxMinLengthShow();
    maxMinHide();
    maxMinSizeHide();
    return;
  }
  if (event.value == "number") {
    maxMinLengthShow();
    maxMinShow();
    maxMinSizeHide();
    return;
  }
  if (event.value == "file") {
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeShow();
    return;
  }
  if (event.value !== ("tel" | "checkbox" | "date" | "email")) {
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();
    return;
  }
}
var addmissionFormGroup = document.getElementById("addmissionFormGroup");
var formFooter = document.getElementById("formFooter");

var formToAppend = document.getElementById("addmissionFormGroup");

// SINGLE JSON DATA OBJECT
let dataObjectJON = null;
// DATA OBJECT TO UPLOAD INTO DATABASE
let dataObjectToUpload = [];
// ADD FIELDS TO FORM FUNCTION
$("#addmissionFieldsForm").submit(function (e) {
  e.preventDefault();
  f++;
  var form = $("#addmissionFieldsForm")[0];
  let formData = new FormData(form);
  console.log(Array.from(formData));

  // MAKING VARIABLE FROM FIELDS
  var fieldNameSmall = slugify($("#field_name").val()) + "-" + f;
  var fieldName = $("#field_name").val();
  var field_type = $("#field_type").val();
  var input_type = $("#input_type").val();

  var required_field = $("#required_field");

  // PARENT DIV
  if (mode == "edit") {
    var DIV = document.getElementById(mode_div_id);
    DIV.classList.add(fieldNameSmall);
    DIV.setAttribute("id", fieldNameSmall);
    DIV.innerHTML = null;
  } else {
    var DIV = document.createElement("div");
    DIV.classList.add("json-data");
    DIV.classList.add(fieldNameSmall);
    DIV.setAttribute("id", fieldNameSmall);
  }

  // IF CONDITIONS FOR INPUT, SELECT ETC....
  if (formData.get("field_type") == "input") {
    var requiredField = false;
    // DATA/JSON OBJECT FOR DATABASE FOR CREATING SAME FORM AGAIN OR SHOWING TO USER
    if (required_field.is(":checked")) {
      requiredField = true;
    }
    dataObjectJON = {
      input_type: input_type,
      field_name: fieldNameSmall,
      required: requiredField,
      label: $("#field_name").val(),
      maxlength: $("#maxlength").val(),
      minlength: $("#minlength").val(),
      max: $("#maxValue").val(),
      min: $("#minValue").val(),
      maxsize: $("#maxSize").val(),
    };

    if (input_type == "file") {
      // CREATING COMMON INPUT FIELD
      var INPUT = document.createElement("input");
      INPUT.classList.add("form-control");
      INPUT.setAttribute("name", fieldNameSmall);
      INPUT.setAttribute("type", input_type);
      INPUT.setAttribute("id", fieldNameSmall);
      INPUT.setAttribute("max-file-size", dataObjectJON.maxSize);

      var LABEL = document.createElement("label");
      LABEL.setAttribute("for", fieldNameSmall);
      LABEL.classList.add("bmd-label-floating");
      LABEL.innerHTML = fieldName;

      var SMALL = document.createElement("small");
      SMALL.classList.add("removeFieldForm");
      SMALL.setAttribute("id", f);
      SMALL.setAttribute("style", "cursor:pointer;");

      var STRONG = document.createElement("strong");
      STRONG.innerHTML = "Remove";
      SMALL.appendChild(STRONG);

      var EDIt = document.createElement("small");
      EDIt.classList.add("editThisField");
      EDIt.setAttribute("id", f);
      EDIt.setAttribute("style", "cursor:pointer;float: right;");

      var EDITTEXT = document.createElement("strong");
      EDITTEXT.innerHTML = "  Edit";

      EDIt.appendChild(EDITTEXT);

      if (!required_field.is(":checked")) {
        INPUT.removeAttribute("required");
      } else {
        INPUT.setAttribute("required", "required");
      }

      // APPENDING DATA TOGETHER
      DIV.classList.add("file-div");
      DIV.setAttribute("json-data", JSON.stringify(dataObjectJON));
      DIV.appendChild(LABEL);
      DIV.appendChild(INPUT);
      DIV.appendChild(SMALL);
      DIV.appendChild(EDIt);

      fieldAddingFormReset();
    } else {
      // CREATING COMMON INPUT FIELD
      var INPUT = document.createElement("input");
      INPUT.classList.add("form-control");
      INPUT.setAttribute("name", fieldNameSmall);
      INPUT.setAttribute("type", input_type);
      INPUT.setAttribute("id", fieldNameSmall);

      var LABEL = document.createElement("label");
      LABEL.setAttribute("for", fieldNameSmall);
      LABEL.classList.add("bmd-label-floating");
      LABEL.innerHTML = fieldName;

      var SMALL = document.createElement("small");
      SMALL.classList.add("removeFieldForm");
      SMALL.setAttribute("id", f);
      SMALL.setAttribute("style", "cursor:pointer;");

      var STRONG = document.createElement("strong");
      STRONG.innerHTML = "Remove";
      SMALL.appendChild(STRONG);

      var EDIt = document.createElement("small");
      EDIt.classList.add("editThisField");
      EDIt.setAttribute("id", f);
      EDIt.setAttribute("style", "cursor:pointer;float: right;");

      var EDITTEXT = document.createElement("strong");
      EDITTEXT.innerHTML = "  Edit";

      EDIt.appendChild(EDITTEXT);

      if (!required_field.is(":checked")) {
        INPUT.removeAttribute("required");
      } else {
        INPUT.setAttribute("required", "required");
      }

      // EXTRA INPUT FIELD ATTRIBUTES
      if (input_type == "text") {
        INPUT.setAttribute("maxlength", dataObjectJON.maxlength);
        INPUT.setAttribute("minlength", dataObjectJON.minlength);

        var dataObjectJON = new InputText(dataObjectJON);
        console.log(dataObjectJON);
      }
      if (input_type == "email") {
        var dataObjectJON = new InputEmail(dataObjectJON);
        console.log(dataObjectJON);
      }
      if (input_type == "number") {
        INPUT.setAttribute("maxlength", dataObjectJON.maxlength);
        INPUT.setAttribute("minlength", dataObjectJON.minlength);
        INPUT.setAttribute("max", dataObjectJON.max);
        INPUT.setAttribute("min", dataObjectJON.min);

        var dataObjectJON = new InputNumber(dataObjectJON);
        console.log(dataObjectJON);
      }
      if (input_type == "tel") {
        var dataObjectJON = new InputTel(dataObjectJON);
        console.log(dataObjectJON);
      }
      if (input_type == "checkbox") {
        var dataObjectJON = new InputCheckbox(dataObjectJON);
        console.log(dataObjectJON);
      }
      if (input_type == "date") {
        var dataObjectJON = new InputDate(dataObjectJON);
        console.log(dataObjectJON);
      }
      DIV.setAttribute("json-data", JSON.stringify(dataObjectJON));
      // APPENDING DATA TOGETHER
      DIV.appendChild(LABEL);
      DIV.appendChild(INPUT);
      DIV.appendChild(SMALL);
      DIV.appendChild(EDIt);

      fieldAddingFormReset();
    }
  }

  if (formData.get("field_type") == "textarea") {
    // DATA/JSON OBJECT FOR DATABASE FOR CREATING SAME FORM AGAIN OR SHOWING TO USER
    dataObjectJON = {
      input_type: input_type,
      field_name: fieldNameSmall,
      required: $("#required_field").val(),
      label: $("#field_name").val(),
      maxlength: $("#maxlength").val(),
      minlength: $("#minlength").val(),
    };
    var dataObjectJON = new TextArea(dataObjectJON);
    console.log(dataObjectJON);

    var TEXTAREA = document.createElement("textarea");
    TEXTAREA.classList.add("form-control");
    TEXTAREA.setAttribute("name", fieldNameSmall);
    TEXTAREA.setAttribute("rows", 5);
    TEXTAREA.setAttribute("id", fieldNameSmall);
    TEXTAREA.setAttribute("required", "required");
    TEXTAREA.setAttribute("placeholder", fieldName);

    if (!required_field.is(":checked")) {
      TEXTAREA.removeAttribute("required");
    } else {
      TEXTAREA.setAttribute("required", "required");
    }

    var SMALL = document.createElement("small");
    SMALL.classList.add("removeFieldForm");
    SMALL.setAttribute("id", f);
    SMALL.setAttribute("style", "cursor:pointer;");

    var STRONG = document.createElement("strong");
    STRONG.innerHTML = "Remove";
    var EDIt = document.createElement("small");
    EDIt.classList.add("editThisField");
    EDIt.setAttribute("id", f);
    EDIt.setAttribute("style", "cursor:pointer;float: right;");

    var EDITTEXT = document.createElement("strong");
    EDITTEXT.innerHTML = "  Edit";

    EDIt.appendChild(EDITTEXT);
    // APPENDING DATA TOGETHER
    SMALL.appendChild(STRONG);
    DIV.setAttribute("json-data", JSON.stringify(dataObjectJON));
    DIV.appendChild(TEXTAREA);
    DIV.appendChild(SMALL);
    DIV.appendChild(EDIt);

    fieldAddingFormReset();
  }

  if (formData.get("field_type") == "select") {
    var SELECT = document.createElement("select");
    SELECT.classList.add("custom-select");
    SELECT.setAttribute("style", "position: relative;");
    SELECT.setAttribute("name", fieldNameSmall);
    SELECT.setAttribute("id", fieldNameSmall);
    SELECT.setAttribute("required", "required");

    if (!required_field.is(":checked")) {
      SELECT.removeAttribute("required");
    } else {
      SELECT.setAttribute("required", "required");
    }
    var OPTION = document.createElement("option");
    OPTION.setAttribute("selected", "selected");
    OPTION.setAttribute("disabled", "disabled");
    OPTION.innerHTML = "Select " + fieldName;
    SELECT.appendChild(OPTION);

    var options = document.getElementsByName("field_typeOption[]");
    var index = 0;
    var selectOptions = [];
    for (index; index < options.length; index++) {
      // console.log(options[index].value);
      var OPTION = document.createElement("option");
      OPTION.setAttribute("value", options[index].value);
      OPTION.innerHTML = options[index].value;
      selectOptions.push(options[index].value);
      // console.log(selectOptions);
      SELECT.appendChild(OPTION);
    }

    // DATA/JSON OBJECT FOR DATABASE FOR CREATING SAME FORM AGAIN OR SHOWING TO USER
    dataObjectJON = {
      input_type: input_type,
      field_name: fieldNameSmall,
      required: $("#required_field").val(),
      label: $("#field_name").val(),
      options: selectOptions,
    };
    var dataObjectJON = new SelectField(dataObjectJON);
    console.log(dataObjectJON);

    var SMALL = document.createElement("small");
    SMALL.classList.add("removeFieldForm");
    SMALL.setAttribute("id", f);
    SMALL.setAttribute("style", "cursor:pointer;");

    var STRONG = document.createElement("strong");
    STRONG.innerHTML = "Remove";

    SMALL.appendChild(STRONG);

    var EDIt = document.createElement("small");
    EDIt.classList.add("editThisField");
    EDIt.setAttribute("id", f);
    EDIt.setAttribute("style", "cursor:pointer;float: right;");

    var EDITTEXT = document.createElement("strong");
    EDITTEXT.innerHTML = "  Edit";

    EDIt.appendChild(EDITTEXT);

    // APPENDING DATA TOGETHER
    DIV.setAttribute("json-data", JSON.stringify(dataObjectJON));
    DIV.classList.add("json-data");
    DIV.appendChild(SELECT);
    DIV.appendChild(SMALL);
    DIV.appendChild(EDIt);
    // APPEND FORM FIELDS TO HTML
    onAllRemove();
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    fieldAddingFormReset();
  }

  // APPEND FORM FIELDS TO HTML && CREATING JSON DATA
  if (mode == "edit") {
    dataObjectToUpload.splice(mode_index, 1, dataObjectJON);
    dataObjectToUpload.push(dataObjectJON);

    mode = null;
    mode_div_id = null;
    mode_index = null;
  } else {
    dataObjectToUpload.push(dataObjectJON);
    formToAppend.appendChild(DIV);
  }

  form_fields.val(JSON.stringify(dataObjectToUpload));
  console.log(dataObjectToUpload);

  // if (formData.get("field_type") == "file") {
  //   return;
  // }
});

function addSelectOption(value = "") {
  i++;
  $("#selectFieldData").append(
    '<div class="form-group field_typeOptionsDiv" id="field_typeOptionsDiv' +
      i +
      '"><label for="field_typeOption' +
      i +
      '" class="bmd-label-floating">Option' +
      i +
      '</label><input class="form-control" name="field_typeOption[]" value="' +
      value +
      '" id="field_typeOption' +
      i +
      '" required><small style="cursor:pointer;" class="removingbutton" id="' +
      i +
      '"><strong>Remove</strong></small></div>'
  );
}

$(document).on("click", ".removeFieldForm", function () {
  console.log(dataObjectToUpload);
  // console.log('removing start')
  // $(this).parent().remove();
  var div_id = $(this).parent().attr("id");
  $("#" + div_id).remove();
  form_fields.val(JSON.stringify(dataObjectToUpload));
  // console.log(form_fields.val());

  // const result = dataObjectToUpload.find(({ field_name }) => field_name === div_id);
  // console.log(result);

  const index = dataObjectToUpload.findIndex(
    ({ field_name }) => field_name === div_id
  );
  console.log(index); // 3
  console.log(dataObjectToUpload[index]);

  dataObjectToUpload.splice(index, 1);
  console.log(dataObjectToUpload);
});

// EDIT FIELD BUTTON
$(document).on("click", ".editThisField", function () {
  mode = "edit";
  console.log(dataObjectToUpload);
  var jsonData = $(this).parent().attr("json-data");
  var thisData = JSON.parse(jsonData);
  console.log(thisData);

  var div_id = $(this).parent().attr("id");
  console.log(div_id);
  mode_div_id = div_id;

  const thisObject = dataObjectToUpload.filter(
    (item) =>
      item.input_type == thisData.input_type &&
      item.field_name == thisData.field_name
  );
  console.log(thisObject);

  const dataindex = dataObjectToUpload.findIndex(
    (item) =>
      item.input_type == thisData.input_type &&
      item.field_name == thisData.field_name
  );
  console.log(dataindex);
  mode_index = dataindex;

  var field_name = $("#field_name");
  var required_field = $("#required_field");
  var maxlength = $("#maxlength");
  var minlength = $("#minlength");
  var maxValue = $("#maxValue");
  var minValue = $("#minValue");
  var maxSize = $("#maxSize");

  if (thisData.required == true) {
    $("#required_field").prop("checked", true);
    // $("#required_field").attr("checked", "checked");
  } else {
    $("#required_field").prop("checked", false);
  }

  document.getElementById("commonFields").removeAttribute("hidden");

  if (thisData.input_type == "text") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthShow();
    maxMinHide();
    maxMinSizeHide();

    // field_type.val("text");
    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="text"]').attr("selected", "selected");
    // input_type.val("text");
    field_name.val(thisData.label);
    maxlength.val(thisData.maxlength);
    minlength.val(thisData.minlength);
  }
  if (thisData.input_type == "email") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="email"]').attr("selected", "selected");
    field_name.val(thisData.label);
  }
  if (thisData.input_type == "number") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthShow();
    maxMinShow();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="number"]').attr("selected", "selected");
    field_name.val(thisData.label);
    maxlength.val(thisData.maxlength);
    minlength.val(thisData.minlength);
    maxValue.val(thisData.maxlength);
    minValue.val(thisData.minlength);
  }
  if (thisData.input_type == "tel") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="tel"]').attr("selected", "selected");
    field_name.val(thisData.label);
  }
  if (thisData.input_type == "checkbox") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="checkbox"]').attr("selected", "selected");
    field_name.val(thisData.label);
  }
  if (thisData.input_type == "date") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="date"]').attr("selected", "selected");
    field_name.val(thisData.label);
  }
  if (thisData.input_type == "file") {
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    inputFieldData.removeAttribute("hidden");
    onAllRemove();
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeShow();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="file"]').attr("selected", "selected");
    field_name.val(thisData.label);
    maxSize.val(thisData.maxsize);
  }
  if (thisData.input_type == "select") {
    inputFieldData.setAttribute("hidden", "hidden");
    selectFieldData.removeAttribute("hidden");
    selectOptionsButton.removeAttribute("hidden");
    maxMinLengthHide();
    maxMinHide();
    maxMinSizeHide();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="select"]').attr("selected", "selected");
    field_name.val(thisData.label);
    thisData.options.forEach((option) => {
      addSelectOption(option);
    });
  }
  if (thisData.input_type == "textarea") {
    inputFieldData.setAttribute("hidden", "hidden");
    selectFieldData.setAttribute("hidden", "hidden");
    selectOptionsButton.setAttribute("hidden", "hidden");
    maxMinLengthShow();
    maxMinHide();
    maxMinSizeHide();
    onAllRemove();

    $('#field_type option[value="input"]').attr("selected", "selected");
    $('#input_type option[value="textarea"]').attr("selected", "selected");
    field_name.val(thisData.label);
    maxlength.val(thisData.maxlength);
    minlength.val(thisData.minlength);
  }
});

function updateThisField() {
  // AFTER SUCCESFULL EDIT FIELD MAKE MODE NULL
  mode = null;
  form_fields.val(dataObjectToUpload);
}

function onAllRemove() {
  $("#selectFieldData").html(null);
  i = 0;
}

function slugify(text) {
  return text
    .toString() // Cast to string
    .toLowerCase() // Convert the string to lowercase letters
    .normalize("NFD") // The normalize() method returns the Unicode Normalization Form of a given string.
    .trim() // Remove whitespace from both sides of a string
    .replace(/\s+/g, "-") // Replace spaces with -
    .replace(/[^\w\-]+/g, "") // Remove all non-word chars
    .replace(/\-\-+/g, "-"); // Replace multiple - with single -
}

// AJAX DATA
let educationArray = [];

async function selectSection(event) {
  var baseurl = $("#baseurl").val();
  // console.log(event.value);
  // console.log(baseurl);

  const api_url = baseurl + "/dashboard/students/getdata/" + event.value;
  let response = await fetch(api_url, {
    method: "post",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  });
  if (response.ok) {
    let dataToPush = null;
    let json = await response.json();
    console.log(json.length);
    educationArray = json;

    dataToPush += "<option disabled selected>Select</option>";

    if (json.length !== 0) {
      for (i = 0; i < json.length; i++) {
        dataToPush +=
          '<option value="' + json[i].id + '">' + json[i].title + "</option>";
      }
      document.getElementById("class_course_selection").innerHTML = dataToPush;
      document.getElementById("coursesSection").removeAttribute("hidden");
      noDataAlert.setAttribute("hidden", "hidden");
    } else {
      document
        .getElementById("coursesSection")
        .setAttribute("hidden", "hidden");
      noDataAlertMessage.innerHTML =
        "No Class / Courses available in this corresponding section, please add some first";
      noDataAlert.classList.add(classWaring);
      noDataAlert.removeAttribute("hidden");
    }
  } else {
    alert(
      "HTTP-Error: " +
        response.status +
        " \nPlease refresh page before check again."
    );
  }
}

// SAVE FORM FIELDS TO DATABASE
function saveForm() {
  // e.preventDefault();
  form_fields.val(JSON.stringify(dataObjectToUpload));
  // console.log(dataObjectToUpload.length);
  // console.log(dataObjectToUpload);

  // return;
  if (dataObjectToUpload.length > 0) {
    // saveForm();

    console.log(dataObjectToUpload);
    var formData = {
      // service_id: service_id.val(),
      service_id: $("select#service_id option").filter(":selected").val(),
      form_fields: dataObjectToUpload,
      form_heading: form_heading.val(),
      sort_number: sort_number.val(),
      form_status: $("select#form_status option").filter(":selected").val(),
    };
    // return;
    $.ajax({
      type: "POST",
      url: currentPath,
      data: formData,
      // processData: false,
      // contentType: false,
      // headers: { 'X-Requested-With': 'XMLHttpRequest' },
      success: function (data, textStatus, jqXHR) {
        console.log(data);
        // window.location.reload();
        window.location.href = "/administrator/service/forms";
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert("Something Wrong Please Try Again");
      },
    });
  } else {
    if (!form_heading.valid()) {
      $("#form_heading_alert").removeAttr("hidden");
      setTimeout(() => {
        $("#form_heading_alert").attr("hidden");
      }, 1000);
    }
    if (dataObjectToUpload.length == 0 || dataObjectToUpload.length < 1) {
      $("#no_fields_alert").removeAttr("hidden");
      setTimeout(() => {
        $("#no_fields_alert").attr("hidden");
      }, 1000);
    }
    form_heading.validate();
  }
}
$("#addmissionFormEdited").submit(function (e) {
  e.preventDefault();
  var formData = new FormData($("#addmissionFormEdited")[0]);
  console.log(Array.from(formData));
});

function admFormReset() {
  $("#addmissionFormGroup").html(null);
  i = 0;
  f = 0;
}

function fieldAddingFormReset() {
  $("#addmissionFieldsForm")[0].reset();
  document.getElementById("commonFields").setAttribute("hidden", "hidden");
  inputFieldData.setAttribute("hidden", "hidden");
  selectFieldData.setAttribute("hidden", "hidden");
  selectOptionsButton.setAttribute("hidden", "hidden");
  maxMinLengthHide();
  maxMinHide();
  maxMinSizeHide();
  mode = null;
}
function maxMinLengthShow() {
  document.getElementById("inputMaxLength").removeAttribute("hidden");
  document.getElementById("inputMinLength").removeAttribute("hidden");
}
function maxMinLengthHide() {
  document.getElementById("inputMaxLength").setAttribute("hidden", "hidden");
  document.getElementById("inputMinLength").setAttribute("hidden", "hidden");
}
function maxMinShow() {
  document.getElementById("inputMaxValue").removeAttribute("hidden");
  document.getElementById("inputMinValue").removeAttribute("hidden");
}
function maxMinHide() {
  document.getElementById("inputMaxValue").setAttribute("hidden", "hidden");
  document.getElementById("inputMinValue").setAttribute("hidden", "hidden");
}
function maxMinSizeShow() {
  document.getElementById("inputMaxSize").removeAttribute("hidden");
  // document.getElementById("inputMinSize").removeAttribute("hidden");
}
function maxMinSizeHide() {
  document.getElementById("inputMaxSize").setAttribute("hidden", "hidden");
  // document.getElementById("inputMinSize").setAttribute("hidden", "hidden");
}
