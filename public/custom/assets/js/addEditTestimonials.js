var addTestimonialForm = $('#addTestimonialForm');
var testimonialToggleButton = $('#testimonialToggleButton');
var get_testimonial_id = $('#get_testimonial_id');

$(document).ready(function () {
    if (get_testimonial_id.val() != 0) {
        addTestimonialForm.removeAttr('hidden');
        testimonialToggleButton.html('Cancel');
        testimonialToggleButton.removeClass('btn-primary').addClass('btn-danger');
    }
});


function toggleForm() {
    if (addTestimonialForm.attr('hidden')) {
        addTestimonialForm.removeAttr('hidden');
        testimonialToggleButton.html('Cancel');
        testimonialToggleButton.removeClass('btn-primary').addClass('btn-danger');
        return;
    }
    addTestimonialForm.attr('hidden', 'hidden');
    testimonialToggleButton.html('Add');
    testimonialToggleButton.removeClass('btn-danger').addClass('btn-primary');
}