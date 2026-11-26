<?php
// Castle Barbers: all shop details live here.
// Leave a value as '' (empty) to hide it on the website.

return [
    'name'     => 'Castle Barbers',
    'name_first' => 'Castle',   // hero title, line 1
    'name_second' => 'Barbers', // hero title, line 2 (outlined)
    'tagline'  => 'Traditional haircuts & shaves',
    'number'   => '308',
    'road'     => 'Walworth Road',
    'street'   => '308 Walworth Road',
    'city'     => 'London',
    'postcode' => 'SE17 2NA',
    'area'     => 'Walworth',
    'area_long' => 'Walworth, near Elephant & Castle',
    'borough'  => 'London Borough of Southwark',
    'geo_region' => 'GB-SWK',
    'nearby'   => ['Elephant and Castle', 'Kennington', 'Camberwell', 'Borough', 'Bermondsey'],
    'lat'      => 51.4865108,
    'lng'      => -0.0948609,
    'maps_url' => 'https://maps.app.goo.gl/DzFZhcxmE7h5HReo7',

    // Contact. Example: '+44 20 1234 5678'
    'phone'     => '020 7701 8800',   // on the shop sign
    'phone2'    => '07561 260160',    // on Google Maps
    // Enquiries from the contact form go to this address. Empty = form hidden.
    'email'     => '',
    // Online booking link (Fresha, Booksy, etc.). Empty = "Book" buttons hidden.
    'booking_url' => '',
    'instagram'   => '',
    'tiktok'      => '',
    'facebook'    => '',

    // Google rating (update now and then from Google Maps). Empty = hidden.
    'rating'        => '4.9',
    'reviews_count' => '283',
    'reviews_url'   => 'https://www.google.com/maps/place/Castle+Barbers/@51.4865108,-0.0948609,17z/data=!4m8!3m7!1s0x48760516be4253df:0x73157c8a2450b2bd!8m2!3d51.4865108!4d-0.0948609!9m1!1b1',
    // What customers mention most in Google reviews.
    'review_topics' => ['Welcoming atmosphere', 'Polite staff', 'Free drinks', 'Hot towel', "Kids' cuts", 'Skin fades', 'Ear and nose waxing'],

    // Opening hours. Example: 'Monday' => '9:00 – 19:00', 'Sunday' => 'Closed'.
    // If every day is empty, the hours table is hidden.
    'hours' => [
        'Monday'    => '9:00 – 20:00',
        'Tuesday'   => '9:00 – 20:00',
        'Wednesday' => '9:00 – 20:00',
        'Thursday'  => '9:00 – 20:00',
        'Friday'    => '9:00 – 20:00',
        'Saturday'  => '10:00 – 20:00',
        'Sunday'    => '10:00 – 18:00',
    ],

    // Services. 'price' example: '£20'. Empty price = not shown.
    'services' => [
        ['name' => 'Haircut',       'price' => '', 'image' => 'haircut', 'text' => 'Clippers, scissors or both, finished and styled the way you wear it.'],
        ['name' => 'Skin fade',     'price' => '', 'image' => 'fade',    'text' => 'Taken down to the skin and blended clean into the length on top.'],
        ['name' => 'Beard trim',    'price' => '', 'image' => 'beard',   'text' => 'Shaped, lined up and tidied to suit your face.'],
        ['name' => 'Line-up',       'price' => '', 'image' => 'lineup',  'text' => 'Sharp edges on the hairline and neck between full cuts.'],
        ['name' => 'Head shave',      'price' => '', 'image' => 'headshave', 'text' => 'A clean, close shave all over the head with a smooth finish.'],
        ['name' => 'Hot towel shave', 'price' => '', 'image' => 'hottowel',  'text' => 'Warm towels, rich lather and a close razor shave.'],
        ['name' => 'Ear and nose waxing', 'price' => '', 'image' => '', 'text' => 'Quick, tidy waxing to finish off a cut.'],
        ['name' => "Kids' haircut", 'price' => '', 'image' => 'kids',    'text' => 'Cuts for younger customers, done with patience.'],
    ],

    'gallery' => ['g3', 'g2', 'chair', 'g4', 'g5', 'g7'],
];
