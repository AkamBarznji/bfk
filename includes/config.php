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
    'phone'     => '',
    // Enquiries from the contact form go to this address. Empty = form hidden.
    'email'     => '',
    // Online booking link (Fresha, Booksy, etc.). Empty = "Book" buttons hidden.
    'booking_url' => '',
    'instagram'   => '',
    'tiktok'      => '',

    // Opening hours. Example: 'Monday' => '9:00 – 19:00', 'Sunday' => 'Closed'.
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
        ['name' => "Kids' haircut", 'price' => '', 'image' => 'kids',    'text' => 'Cuts for younger customers, done with patience.'],
    ],

    'gallery' => ['g1', 'g2', 'g3', 'g4', 'g5', 'g6', 'g7', 'g8'],
];
