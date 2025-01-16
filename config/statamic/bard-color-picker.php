<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pickr theme
    |--------------------------------------------------------------------------
    |
    | Set the pickr theme
    | https://simonwep.github.io/pickr/
    | Supported: "classic", "monolith", "nano"
    |
    */
    'theme' => 'monolith',

    /*
    |--------------------------------------------------------------------------
    | Main components
    |--------------------------------------------------------------------------
    */
    'components' => [
        'preview' => false, // comparison between old and new color
        'opacity' => false, // opacity slider
        'hue'     => true, // hue slider
    ],

    /*
    |--------------------------------------------------------------------------
    | Pickr swatches (recommended colors)
    |--------------------------------------------------------------------------
    */
    'recommended' => [
        '#fff',
        '#222',
    ],

    /*
    |--------------------------------------------------------------------------
    | Input / output options
    |--------------------------------------------------------------------------
    */
    'interactions' => [
        'hex'   => false,
        'rgba'  => false,
        'hsla'  => false,
        'hsva'  => false,
        'cmyk'  => false,
        'input' => true,
    ],

];
