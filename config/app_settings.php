<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'General Settings',
            'descriptions' => 'Application general settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)
            'id' => 'app',

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'App Name', // label for input
                    // optional properties
                    'placeholder' => 'Application Name', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'value' => 'QCode', // any default value
                    'group' => 'site'
                ],
                [
                    'name' => 'logo',
                    'type' => 'image',
                    'label' => 'Upload logo',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:500',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site',
                ],
                [
                    'name' => 'favicon',
                    'type' => 'image',
                    'label' => 'Upload favicon',
                    'hint' => 'create favicon using favicon-generator.org and upload that image here',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site',
                ],
                [
                    'name' => 'home-image',
                    'type' => 'image',
                    'label' => 'Upload Home Cover',
                    'hint' => 'Must be an image and cropped in desired size',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'home image',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site',
                ],
                [
                    'name' => 'room-cover',
                    'type' => 'image',
                    'label' => 'Rooms Cover',
                    'hint' => 'must be an image of desired size',
                    'disk' => 'public',
                    'path' => 'app',
                    'preview_class' => 'rooms Image',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site'
                ],
                [
                    'name' => 'service-cover',
                    'type' => 'image',
                    'label' => 'Service Cover',
                    'hint' => 'must be an image of desired size',
                    'disk' => 'public',
                    'path' => 'app',
                    'preview_class' => 'service-cover',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site'
                ],
                [
                    'name' => 'place-image',
                    'type' => 'image',
                    'label' => 'Upload Place Cover',
                    'hint' => 'Must be an image and cropped in desired size',
                    'disk' => 'public', // which disk you want to upload
                    'path' => 'app', // path on the disk,
                    'preview_class' => 'home image',
                    'preview_style' => 'height:40px',
                    'class' => 'form-control',
                    'group' => 'site',
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'row' => 5,
                    'column' => 5,
                    'label' => 'Description',
                    'class' => 'form-control',
                    'placeholder' => 'Description about Your Hotel',
                ],
                [
                    'name' => 'room-description',
                    'type' => 'textarea',
                    'row' => 5,
                    'column' => 5,
                    'label' => 'Description about Rooms',
                    'class' => 'form-control',
                    'placeholder' => 'Description about Your Hotel Rooms',

                ],
                [
                    'name' => 'service-description',
                    'type' => 'textarea',
                    'row' => 5,
                    'column' => 5,
                    'label' => 'Description about Services',
                    'class' => 'form-control',
                    'placeholder' => 'Description about Your Services',
                ],
                [
                    'name' => 'place-description',
                    'type' => 'textarea',
                    'row' => 5,
                    'column' => 5,
                    'label' => 'Description about Places',
                    'class' => 'form-control',
                    'placeholder' => 'Description about Places Near your Hotel',
                ],
                [
                    'name' => 'mapframe',
                    'type' => 'textarea',
                    'label' => 'Map Location',
                    'hint' => 'this is your location in google. Copy your map embed code and paste here',
                    'value' => 'map is not attached now',
                ]
            ]
        ],
        'Social' => [
            'title' => 'Social Information',
            'icon' => 'fas fa-hashtag',
            'hint' => 'Social accounts',
            'id' => 'social',

            'inputs' => [
                [
                    'name' => 'facebook_link',
                    'type' => 'text',
                    'label' => 'Facebook Account',
                    'placeholder' => 'Facebook Account Link',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'twitter_link',
                    'type' => 'text',
                    'label' => 'Twitter Account',
                    'placeholder' => 'Twitter Account Link',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'insta_link',
                    'type' => 'text',
                    'label' => 'Instagram Account',
                    'placeholder' => 'Instagram Link',
                    'class' => 'form-control',
                ],
            ]
        ],
        'information' => [
            'title' => 'Information Setting',
            'icon' => 'fas fa-info-circle',
            'hint' => 'These Data goes at footer',
            'id' => 'information',

            'inputs' => [
                [
                    'name' => 'about_us',
                    'type' => 'textarea',
                    'label' => 'About Us',
                    'placeholder' => 'About Us',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'address',
                    'type' => 'textarea',
                    'label' => 'Location',
                    'placeholder' => 'Location',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'phone_number',
                    'type' => 'number',
                    'label' => 'Phone Number',
                    'placeholder' => 'ex: 98XXXXXXXX',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'telephone',
                    'type' => 'number',
                    'label' => 'Telephone Number',
                    'placeholder' => 'ex: 0XX XXX XXX',
                    'class' => 'form-control',
                ],
                [
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Email',
                    'placeholder' => 'ex: hotel@gmail.com',
                    'class' => 'form-control',
                ],

            ]
        ],
        'mail_setup' => [
            'title' => 'Mail Server Setup',
            'hint' => 'This is used to setup mail server',
            'icon' => 'fas fa-envelope',
            'id' => 'mail-setup',

            'inputs' => [
                [
                    'name' => 'username',
                    'placeholder' => 'ex: hotel@gmail.com',
                    'class' => 'form-control',
                    'type' => 'email',
                    'label' => 'Username'
                ],
                [
                    'name' => 'password',
                    'type' => 'text',
                    'label' => 'Password',
                    'class' => 'form-control',
                    'placeholder' => 'your email password here'
                ],
                [
                    'name' => 'port',
                    'type' => 'number',
                    'label' => 'Port',
                    'placeholder' => 'Port number',
                    'class' => 'form-control'
                ],
                [
                    'name' => 'security',
                    'type' => 'select',
                    'label' => 'security',
                    'options' => ['tls', 'ssl'],

                ]
            ]
        ],
        'homepage_setup' => [
            'title' => 'hide and show page layouts',
            'hint' => 'this is used to hide and show front page layouts section',
            'icon' => 'fa fa-home',
            'id' => 'homepage',

            'inputs' => [
                [
                    'name' => 'about',
                    'label' => 'About',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'rooms',
                    'label' => 'Room Accommodation',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'service',
                    'label' => 'Services',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'places',
                    'label' => 'Near By place to Visit',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'testimonial',
                    'label' => 'Testimonial',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'map',
                    'label' => 'Map',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'footer',
                    'label' => 'Footer',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'show-room-desc',
                    'label' => 'Room Description',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'show-service-desc',
                    'label' => 'Service Description',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],
                [
                    'name' => 'show-place-desc',
                    'label' => 'Place Description',
                    'type' => 'boolean',
                    'value' => true,
                    'class' => 'w-auto'
                ],


            ]
        ]
    ],
    // Setting page url, will be used for get and post request
    'url' => '/settings',

    // Any middleware you want to run on above route
    'middleware' => ['auth'],

    // View settings
    'setting_page_view' => 'app_settings::settings_page',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card col-md-10',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function () {
        // return 'user_'.auth()->id();
        return 'group';
    }
];
