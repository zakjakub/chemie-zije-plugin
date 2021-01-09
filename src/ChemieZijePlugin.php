<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ChemieZijePlugin
{

    public function __construct()
    {
        add_action('carbon_fields_register_fields', [$this, 'crbAttachThemeOptions']);
        add_action('after_setup_theme', [$this, 'crbLoad']);
    }

    final public function registerPostTypes(): void
    {
    }

    final public function registerTaxonomies(): void
    {
    }

    final public function crbAttachThemeOptions(): void
    {
        Container::make('theme_options', __('Theme Options'))->add_fields(
            [Field::make('text', 'crb_text', 'Text Field'),]
        );
    }

    final public function crbLoad(): void
    {
        require_once('vendor/autoload.php');
        Carbon_Fields::boot();
    }
}
