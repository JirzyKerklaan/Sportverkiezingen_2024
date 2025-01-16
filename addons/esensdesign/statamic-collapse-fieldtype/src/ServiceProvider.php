<?php

namespace esensdesign\CollapseFieldtype;

use Statamic\Providers\AddonServiceProvider;
use esensdesign\CollapseFieldtype\Fieldtypes\Collapse as CollapseFieldtype;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        CollapseFieldtype::class,
    ];

    protected $scripts = [
        __DIR__.'/../resources/dist/js/cp.js'
    ];

    protected $stylesheets = [
        __DIR__.'/../resources/dist/css/styles.css'
    ];
}
