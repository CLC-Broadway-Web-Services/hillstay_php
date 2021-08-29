<?php

namespace App\Libraries;


class Testimonial
{
    public function testimonial_block($testimonial)
    {
        return view('Frontend/components/testimonial_block', $testimonial);
    }
}
