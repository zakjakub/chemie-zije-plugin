<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ChemieZijePlugin
{

    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'load_carbon_fields']);
        add_action('carbon_fields_register_fields', [$this, 'register_carbon_fields']);
        add_action('carbon_fields_fields_registered', [$this, 'carbon_fields_values_are_available']);
    }

    final public function load_carbon_fields(): void
    {
        Carbon_Fields::boot();
    }

    final public function register_carbon_fields(): void
    {
        Container::make('theme_options', 'YourFancyPlugin options')->add_fields(
            [Field::make('text', 'example_option_1')]
        );
    }

    final public function carbon_fields_values_are_available(): void
    {
        /* retrieve the values of your Carbon Fields related to your plugin */
        var_dump(carbon_get_theme_option('example_option_1'));
        /* do all the stuff that does rely on values of your Carbon Fields */
    }
}
