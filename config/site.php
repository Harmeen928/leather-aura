<?php

return [
    'name'    => 'Leather Aura',
    'tagline' => 'Handcrafted leather, built to age well.',

    // Ye sirf default values hain. Admin panel > Settings se badal sakte hain.
    'phone'   => env('SITE_PHONE', '+92 300 0000000'),
    'email'   => env('SITE_EMAIL', 'info@leatheraura.pk'),
    'address' => 'Rangpura, Sialkot, Punjab, Pakistan',

    // Pehli dafa admin account banane ke liye (login ke baad Settings me change karein)
    'admin_email'    => env('ADMIN_EMAIL', 'admin@leatheraura.pk'),
    'admin_password' => env('ADMIN_PASSWORD', 'ChangeMe123'),

    // Sirf pehli dafa database seed karne ke liye
    'products' => [
        ['name' => 'Leather Jacket',  'line1' => 'WEAR THE',  'line2' => 'LEGEND.',    'text' => 'Premium full-grain jackets cut for a sharp fit and a finish that gets better every year.', 'image' => 'jacket.svg'],
        ['name' => 'Leather Wallet',  'line1' => 'CARRY IT',  'line2' => 'SLIM.',      'text' => 'Hand-stitched wallets with clean edges, tight stitching and a rich natural patina.',      'image' => 'wallet.svg'],
        ['name' => 'Leather Hat',     'line1' => 'TOP IT',    'line2' => 'OFF.',       'text' => 'Structured leather hats that bring attitude to any outfit, day or night.',                'image' => 'hat.svg'],
        ['name' => 'Leather Harness', 'line1' => 'STRAP IN.', 'line2' => 'STAND OUT.', 'text' => 'Bold, adjustable harnesses with solid hardware and a finish made to be seen.',             'image' => 'harness.svg'],
        ['name' => 'Leather Vest',    'line1' => 'LAYER UP,', 'line2' => 'RIDE ON.',   'text' => 'Rugged leather vests built for riders and street style alike.',                           'image' => 'vest.svg'],
        ['name' => 'Leather Gloves',  'line1' => 'GRIP THE',  'line2' => 'ROAD.',      'text' => 'Soft, supple gloves with a precise fit and serious durability.',                          'image' => 'gloves.svg'],
    ],
];
