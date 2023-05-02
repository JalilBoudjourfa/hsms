<?php

return [

    'numerical_keys_prefix' => 'k_',

    'fname' => [
        'min' => 3,
        'max' => 50,
    ],

    'lname' => [
        'min' => 3,
        'max' => 50,
    ],

    'full_name' => [
        'max' => 80,
    ],

    'ar_fname' => [
        'min' => 3,
        'max' => 50,
    ],

    'ar_lname' => [
        'min' => 3,
        'max' => 50,
    ],

    'bplace' => [
        'max' => 32,
    ],

    'bday' => [
        'max' => today()->subYear(3)->toDateString(),
        'min' => today()->subYear(96)->toDateString(),
    ],

    'wilaya' => [
        'max' => 32,
        'min' => 4,
    ],

    'nationality' => [
        'max' => 64,
        'min' => 8,
    ],

    'deposition_date' => [
        'max' => today()->toDateString(),
        'min' => today()->subMonths(9)->toDateString(),
    ],

    'email' => [
        'max' => 72,
    ],

    'number' => [
        'max' => 15,
        'regex' => "/^(?:(?:\+213)|(?:0))[0-9]{5,10}$/",
    ],

    'address' => [
        'max' => 90,
    ],

    'cni' => [
        'max' => 20,
    ],

    'profession' => [
        'max' => 64,
    ],

    'family_title' => [
        'max' => 32,
        'in' => ['father', 'mother'],
    ],

    'sex' => [
        'max' => 16,
        'in' => ['male', 'female'],
    ],

    // 'classroom_state'=>[

    // ],

    'establishment_name' => [
        'max' => '64',
        'min' => '4',
    ],

    'establishment_type' => [
        'max' => '16',
        'min' => '4',
        'in' => ['public', 'privet'],
    ],

    'registration_status' => [
        'max' => 32,
        'min' => 16,
        'in' => ['pending', 'acccepted', 'rejected', 'suspended'],
    ],

    'registration_interview_tite' => [
        'max' => 32,
        'min' => 2,
        'default' => "Entretien d'inscription",
    ],

    'registration_interview_conclusion' => [
        'max' => 32,
        'min' => 2,
        'in' => ['positive', 'negative', 'neutral'],
    ],

    'registration_interview_participant' => [
        'max' => 128,
        'min' => 2,
        'in' => ['père', 'mère', 'père et mère', 'autre'],
    ],

    'capacity' => [
        'between' => '0,127',
    ],

];
