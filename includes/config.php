<?php
// iStyle Barbers: all shop details live here.
// Leave a value as '' (empty) to hide it on the website.

return [
    'name'     => 'iStyle Barbers',
    'street'   => '71 Streatham High Road',
    'city'     => 'London',
    'postcode' => 'SW16 1PH',
    'area'     => 'Streatham',
    'borough'  => 'London Borough of Lambeth',
    'lat'      => 51.4312477,
    'lng'      => -0.1290934,
    'maps_url' => 'https://maps.app.goo.gl/u2WsGJebPNdz1H3V6',

    // Contact. Example: '+44 20 1234 5678'
    'phone'     => '07377 636265',
    // Enquiries from the contact form go to this address. Empty = form hidden.
    'email'     => '',
    // Online booking link (Fresha, Booksy, etc.). Empty = "Book" buttons hidden.
    'booking_url' => '',
    'instagram'   => '',
    'tiktok'      => '',
    'facebook'    => '',

    // Opening hours. Example: 'Monday' => '9:00 – 19:00', 'Sunday' => 'Closed'.
    // If every day is empty, the hours table is hidden.
    'hours' => [
        'Monday'    => '9:00 – 20:00',
        'Tuesday'   => '9:00 – 20:00',
        'Wednesday' => '9:00 – 20:00',
        'Thursday'  => '9:00 – 20:00',
        'Friday'    => '9:00 – 20:00',
        'Saturday'  => '9:00 – 20:00',
        'Sunday'    => '10:00 – 17:30',
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
