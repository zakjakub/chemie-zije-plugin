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
        define('Carbon_Fields\DIR', get_parent_theme_file_path('vendor/htmlburger/carbon-fields'));
        define('Carbon_Fields\URL', trailingslashit(plugin_dir_url(__FILE__)).'vendor/htmlburger/carbon-fields/');
        Carbon_Fields::boot();
    }

    final public function registerCarbonFields(): void
    {
        Container::make('theme_options', 'YourFancyPlugin options')->add_fields(
            [Field::make('text', 'example_option_1')]
        );
    }
}
