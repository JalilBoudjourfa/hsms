<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute must be accepted.',
    'accepted_if' => ':attribute must be accepted when :other is :value.',
    'active_url' => ':attribute is not a valid URL.',
    'after' => ':attribute must be a date after :date.',
    'after_or_equal' => ':attribute must be a date after or equal to :date.',
    'alpha' => ':attribute must only contain letters.',
    'alpha_dash' => ':attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => ':attribute must only contain letters and numbers.',
    'array' => ':attribute must be an array.',
    'before' => ':attribute must be a date before :date.',
    'before_or_equal' => ':attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => ':attribute must be between :min and :max.',
        'file' => ':attribute must be between :min and :max kilobytes.',
        'string' => ':attribute must be between :min and :max characters.',
        'array' => ':attribute must have between :min and :max items.',
    ],
    'boolean' => ':attribute field must be true or false.',
    'confirmed' => ':attribute confirmation does not match.',
    'current_password' => 'password is incorrect.',
    'date' => ':attribute is not a valid date.',
    'date_equals' => ':attribute must be a date equal to :date.',
    'date_format' => ':attribute does not match the format :format.',
    'different' => ':attribute and :other must be different.',
    'digits' => ':attribute must be :digits digits.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'dimensions' => ':attribute has invalid image dimensions.',
    'distinct' => ':attribute field has a duplicate value.',
    'email' => ':attribute doit être une adresse e-mail valide.',
    'ends_with' => ':attribute must end with one of the following: :values.',
    'exists' => 'selected :attribute is invalid.',
    'file' => ':attribute must be a file.',
    'filled' => ':attribute field must have a value.',
    'gt' => [
        'numeric' => ':attribute must be greater than :value.',
        'file' => ':attribute must be greater than :value kilobytes.',
        'string' => ':attribute must be greater than :value characters.',
        'array' => ':attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute must be greater than or equal to :value.',
        'file' => ':attribute must be greater than or equal to :value kilobytes.',
        'string' => ':attribute must be greater than or equal to :value characters.',
        'array' => ':attribute must have :value items or more.',
    ],
    'image' => ':attribute must be an image.',
    'in' => 'selected :attribute is invalid.',
    'in_array' => ':attribute field does not exist in :other.',
    'integer' => ':attribute doit etre un entier.',
    'ip' => ':attribute must be a valid IP address.',
    'ipv4' => ':attribute must be a valid IPv4 address.',
    'ipv6' => ':attribute must be a valid IPv6 address.',
    'json' => ':attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => ':attribute must be less than :value.',
        'file' => ':attribute must be less than :value kilobytes.',
        'string' => ':attribute must be less than :value characters.',
        'array' => ':attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute must be less than or equal to :value.',
        'file' => ':attribute must be less than or equal to :value kilobytes.',
        'string' => ':attribute must be less than or equal to :value characters.',
        'array' => ':attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute must not be greater than :max.',
        'file' => ':attribute must not be greater than :max kilobytes.',
        'string' => ':attribute must not be greater than :max characters.',
        'array' => ':attribute must not have more than :max items.',
    ],
    'mimes' => ':attribute must be a file of type: :values.',
    'mimetypes' => ':attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute must be at least :min.',
        'file' => ':attribute must be at least :min kilobytes.',
        'string' => ':attribute doit contenir au moin :min characteres.',
        'array' => ':attribute must have at least :min items.',
    ],
    'multiple_of' => ':attribute must be a multiple of :value.',
    'not_in' => 'selected :attribute is invalid.',
    'not_regex' => 'Le format du \':attribute\' est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'password' => 'password is incorrect.',
    'present' => ':attribute field must be present.',
    'regex' => 'Le format du \':attribute\' est invalide.',
    'required' => ':attribute est mondataire',
    'required_if' => ':attribute field is required when :other is :value.',
    'required_unless' => ':attribute field is required unless :other is in :values.',
    'required_with' => ':attribute field is required when :values is present.',
    'required_with_all' => ':attribute field is required when :values are present.',
    'required_without' => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'prohibited' => ':attribute field is prohibited.',
    'prohibited_if' => ':attribute field is prohibited when :other is :value.',
    'prohibited_unless' => ':attribute field is prohibited unless :other is in :values.',
    'prohibits' => ':attribute field prohibits :other from being present.',
    'same' => ':attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute must be :size.',
        'file' => ':attribute must be :size kilobytes.',
        'string' => ':attribute must be :size characters.',
        'array' => ':attribute must contain :size items.',
    ],
    'starts_with' => ':attribute must start with one of the following: :values.',
    'string' => ':attribute must be a string.',
    'timezone' => ':attribute must be a valid timezone.',
    'unique' => ':attribute has already been taken.',
    'uploaded' => ':attribute failed to upload.',
    'url' => ':attribute must be a valid URL.',
    'uuid' => ':attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'fname' => 'Le prénom',
        'ar_fname' => 'Le prénom en arabe',
        'lname' => 'Le nom',
        'ar_lname' => 'Le nom en arabe',
        'email' => 'L\'E-mail',
        'phone' => 'Le numéro de téléphone',
        'bday' => 'La date de naissance',
        'bplace' => 'Le lieu de naissance',
        'profession' => 'La profession',
        'content' => 'Le contenu',
        'number' => 'Numéro de téléphone',
    ],

];
