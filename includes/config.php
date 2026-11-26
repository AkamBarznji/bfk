<?php
// Castle Barbers: all shop details live here.
// Leave a value as '' (empty) to hide it on the website.

return [
    'name'     => 'Castle Barbers',
    'name_first' => 'Castle',   // hero title, line 1
    'name_second' => 'Barbers', // hero title, line 2 (outlined)
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
    'maps_url' => 'https://maps.app.goo.gl/1Msx4ULX4FCzDp9q7',

    // Contact. Example: '+44 20 1234 5678'
    'phone'     => '020 7701 8800',
    // Enquiries from the contact form go to this address. Empty = form hidden.
    'email'     => '',
    // Online booking link (Fresha, Booksy, etc.). Empty = "Book" buttons hidden.
    'booking_url' => '',
    'instagram'   => '',
    'tiktok'      => '',
    'facebook'    => '',

    // Opening hours. Example: 'Monday' => '', 'Sunday' => 'Closed'.
    // If every day is empty, the hours table is hidden.
    'hours' => [
        'Monday'    => '',
        'Tuesday'   => '',
        'Wednesday' => '',
        'Thursday'  => '',
        'Friday'    => '',
        'Saturday'  => '',
        'Sunday'    => '',
    ],

    // Services. 'price' example: '£20'. Empty price = not shown.
    'services' => [
        ['name' => 'Haircut',       'price' => '', 'image' => 'haircut', 'text' => 'Clippers, scissors or both, finished and styled the way you wear it.'],
        ['name' => 'Skin fade',     'price' => '', 'image' => 'fade',    'text' => 'Taken down to the skin and blended clean into the length on top.'],
        ['name' => 'Beard trim',    'price' => '', 'image' => 'beard',   'text' => 'Shaped, lined up and tidied to suit your face.'],
        ['name' => 'Line-up',       'price' => '', 'image' => 'lineup',  'text' => 'Sharp edges on the hairline and neck between full cuts.'],
        ['name' => 'Head shave',      'price' => '', 'image' => 'headshave', 'text' => 'A clean, close shave all over the head with a smooth finish.'],
        ['name' => 'Hot towel shave', 'price' => '', 'image' => 'hottowel',  'text' => 'Warm towels, rich lather and a close razor shave.'],
        ['name' => "Kids' haircut", 'price' => '', 'image' => 'kids',    'text' => 'Cuts for younger customers, done with patience.'],
    ],

    'gallery' => ['g3', 'g2', 'chair', 'g4', 'g5', 'g7'],
];
