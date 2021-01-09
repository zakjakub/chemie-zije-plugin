<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ChemieZijePlugin
{

    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerCarbonFields']);
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerCarbonFields(): void
    {
        Container::make('theme_options', 'YourFancyPlugin options')->add_fields(
            [Field::make('text', 'example_option_1')]
        );
    }
}
