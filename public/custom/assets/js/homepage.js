var typed = new Typed('.typed-words', {
    strings: ["Attractions", " Restaurants", " Hotels"],
    typeSpeed: 80,
    backSpeed: 80,
    backDelay: 4000,
    startDelay: 1000,
    loop: true,
    showCursor: true
});
var serachForm = $('#searchFrom');

function qtySum() {
  if(document.querySelector(".qtyTotal")) {
    // var arr = document.getElementsByName("qtyInput");
    var arr = document.getElementsByClassName("qtyInput");
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value)) tot += parseInt(arr[i].value);
    }
    // var qtyInputTotal = document.querySelector("#qtyInputTotal");
    var qtyInputTotal = $('#qtyInputTotal');
    qtyInputTotal.val(tot);

    var cardQty = document.querySelector(".qtyTotal")
    cardQty.innerHTML = qtyInputTotal.val();
    var formData = new FormData(serachForm[0]);
    console.log(Array.from(formData));
  }
}
qtySum();
$(function () {
    $(".qtyButtons input").after('<div class="qtyInc"></div>');
    $(".qtyButtons input").before('<div class="qtyDec"></div>');

    $(".qtyDec, .qtyInc").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("qtyInc")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        if($button.parent().find("input").attr('min') <= newVal && $button.parent().find("input").attr('max') >= newVal) {
            $button.parent().find("input").val(newVal);
            qtySum();
        }
        $(".qtyTotal").addClass("rotate-x");
    });
    function removeAnimation() {
        $(".qtyTotal").removeClass("rotate-x");
    }
    if(document.querySelector(".qtyTotal")) {
      const counter = document.querySelector(".qtyTotal");
      counter.addEventListener("animationend", removeAnimation);
    }
});

