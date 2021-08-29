var serviceGetStarted = $("#serviceGetStarted");
var serviceCheckoutForm = $("#serviceCheckoutForm");

$(document).ready(function () {
  serviceGetStarted.on("submit", function (event) {
    event.preventDefault();
    serviceGetStartedSubmition();
  });
  var userData = localStorage.getItem("service_user_details");
  if (userData) {
    var userdata = JSON.parse(userData);
    const now = new Date();
    // compare the expiry time of the item with the current time
    if (now.getTime() > userdata.expiry) {
      // If the item is expired, delete the item from storage
      // and return null
      localStorage.removeItem("service_user_details");
      return null;
    } else {
      console.log(userdata);
      for (var key in userdata) {
        $("#"+key).val(userdata[key])
      }
      //   $("#user_firstname").val(userdata.user_firstname);
      //   $("#user_lastname").val(userdata.user_lastname);
      //   $("#user_email").val(userdata.user_email);
      //   $("#user_mobile").val(userdata.user_mobile);
    }
  }
  //   serviceCheckoutForm.on("submit", function (event) {
  //     event.preventDefault();
  //   });
});

function saveFieldData(event) {
  var fieldName = "";
  fieldName = event.id;
  var userData = localStorage.getItem("service_user_details");
  var userdata = {};
  if (userData) {
    userdata = JSON.parse(userData);
    console.log(event.value);
    console.log(event.id);
    userdata[fieldName] = event.value;
    var stringifyArray = JSON.stringify(userdata);
    localStorage.setItem("service_user_details", stringifyArray);
  } else {
    console.log(event.value);
    console.log(event.id);
    userdata[event.id] = event.value;
    var stringifyArray = JSON.stringify(userdata);
    localStorage.setItem("service_user_details", stringifyArray);
  }
}

function serviceGetStartedSubmition() {
  //   var formData = new FormData(serviceGetStarted[0]);
  console.log(serviceGetStarted.serializeArray());
  //   var formArray = Array.from(formData);

  const now = new Date();
  var formArray = {
    user_firstname: $("#user_firstname").val(),
    user_lastname: $("#user_lastname").val(),
    user_email: $("#user_email").val(),
    user_mobile: $("#user_mobile").val(),
    expiry: now.getTime() + 1800000,
  };
  var stringifyArray = JSON.stringify(formArray);

  localStorage.setItem("service_user_details", stringifyArray);

  window.location.href = window.location.pathname + "/packages";
}
