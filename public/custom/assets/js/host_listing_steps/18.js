const nightsmin = $('#nightsmin');

const nightsmax = $('#nightsmax');



function addminNight() {
    nightsmin.val(parseInt(nightsmin.val()) + 1);
}
function removeminNight() {
    if (parseInt(nightsmin.val()) > 1) {
        nightsmin.val(parseInt(nightsmin.val()) - 1);
    }
}
function addmaxNight() {
    if (parseInt(nightsmin.val()) > parseInt(nightsmax.val())) {
        nightsmax.val(parseInt(nightsmin.val()) + 1);
    } else {
        nightsmax.val(parseInt(nightsmax.val()) + 1);
    }
}
function removemaxNight() {
    if (parseInt(nightsmin.val()) == parseInt(nightsmax.val())) {
        nightsmax.val(null);
        return;
    }
    if (parseInt(nightsmax.val()) > parseInt(nightsmin.val())) {
        nightsmax.val(parseInt(nightsmax.val()) - 1);
    }
}