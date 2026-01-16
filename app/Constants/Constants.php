<?php

namespace App\Constants;

class Constants
{
    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';
    const TEACHER_ROLE = 'teacher';
    const MALE_GENDER = 'MALE';
    const FEMALE_GENDER = 'FEMALE';

    const SECTIONS_TYPES = [
        'services' => [
            'attributes' => [
                'logo',
                'title',
                'description',
            ],
            'rules' => [
                'create' => [
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'logo' => 'required|image|mimes:jpeg,png,jpg',
                ],
                'update' => [
                    'title' => 'nullable|string',
                    'description' => 'nullable|string',
                    'logo' => 'image|mimes:jpeg,png,jpg',
                ],
            ],
        ],

    ];

    const SLIDERS_TYPES = [
        'projects',
        'services',
    ];
}
