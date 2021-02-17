<?php

return [
    'per_page' => 20,
    'menu' => [
        '0' => 'USE', // user
        '1' => 'PAY', // payment
        '2' => '', // contact
        '3' => 'CON', // content
        '4' => '', // mail reply
        '5' => 'KAN', // admin
        '6' => 'TOP', // information
        '7' => 'MEI', // officer
        '8' => 'REF', // refining case
        '9' => 'PUB', // publication
        '10' => 'LEC', // seminar
        '11' => 'MMG', // mail newsletter,
        '12' => 'REFMEM' // refining case member
    ],
    'menu_link' => [
        '0' => 'users.edit',
        '1' => 'payments.show',
        '2' => '',
        '3' => 'contents.edit',
        '4' => '',
        '5' => 'admins.edit',
        '6' => 'informations.edit',
        '7' => 'officers.edit',
        '8' => 'refiningCases.edit',
        '9' => 'publications.edit',
        '10' => 'seminars.edit',
        '11' => 'mailNewsletters.edit',
        '12' => 'refiningCasesMembers.edit'
    ],
    'action_type' => [
        '0' => 'Add',
        '1' => 'Update',
        '2' => 'Delete',
        '3' => 'Processed',
        '4' => 'Unprocessed',
        '5' => 'Login',
        '6' => 'Cancel confirm payment'
    ]
];