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

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL valida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute solo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, numeros y guiones.',
    'alpha_num'            => 'El campo :attribute solo puede contener letras y numeros.',
    'array'                => 'El campo :attribute debe ser un arreglo.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file'    => 'El campo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser true o false.',
    'confirmed'            => 'El campo :attribute de confirmación no coincide.',
    'date'                 => 'El campo :attribute no es una fecha valida.',
    'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    'different'            => 'El campo :attribute y :other deben ser diferentes.',
    'digits'               => 'El campo :attribute debe ser de :digits digitos.',
    'digits_between'       => 'El campo :attribute debe estar entre :min y :max digitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones no validas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute debe ser una dirección de correo valida.',
    'exists'               => 'El campo :attribute seleccionado es invalido.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute seleccionado es invalido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP valida.',
    'ipv4'                 => 'El campo :attribute debe ser una dirección IPv4 valida.',
    'ipv6'                 => 'El campo :attribute debe ser una dirección IPv6 valida.',
    'json'                 => 'El campo :attribute debe ser una cadena JSON valida.',
    'max'                  => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'file'    => 'El campo :attribute no puede ser mayor que :max kilobytes.',
        'string'  => 'El campo :attribute no puede ser mayor que :max caracteres.',
        'array'   => 'El campo :attribute may not have more than :max items.',
    ],
    'mimes'                => 'El campo :attribute must be a file of type: :values.',
    'mimetypes'            => 'El campo :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute must be at least :min.',
        'file'    => 'El campo :attribute must be at least :min kilobytes.',
        'string'  => 'El campo :attribute must be at least :min characters.',
        'array'   => 'El campo :attribute debe tener por lo menos :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es invalido.',
    'numeric'              => 'El campo :attribute debe ser un numero.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El campo :attribute tiene un formato invalido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a no ser que :other sea :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values esta presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values estan presentes.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no esta presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando :values no estan presentes.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El campo :attribute debe ser de :size kilobytes.',
        'string'  => 'El campo :attribute debe ser de :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena.',
    'timezone'             => 'El campo :attribute debe ser una zona valida.',
    'unique'               => 'El campo :attribute ya se ha utilizado.',
    'uploaded'             => 'El campo :attribute fallo en la subida',
    'url'                  => 'El campo :attribute tiene un formato invalido.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
