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
        add_action('carbon_fields_register_fields', [$this, 'registerOptionsFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactFields']);
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerOptionsFields(): void
    {
        $mainSettings = Container::make('theme_options', 'Nastavení webu');
        $mainSettings->add_fields([Field::make('text', 'example_option_1')]);
        $contactSettings = Container::make('theme_options', 'Kontakt');
        assert($contactSettings instanceof Container\Theme_Options_Container);
        $contactSettings->set_page_parent($mainSettings);
        $contactSettings->add_fields($this->getContactFields());
    }

    final public function getContactFields(): array
    {
        return [
            Field::make('text', 'name', 'Název'),
            Field::make('text', 'department', 'Katedra'),
            Field::make('text', 'faculty', 'Fakulta'),
            Field::make('text', 'university', 'Univerzita'),
            Field::make('text', 'street', 'Ulice'),
            Field::make('text', 'house_number', 'Číslo popisné')->set_attribute('type', 'number'),
            Field::make('text', 'postal_code', 'Směrovací číslo'),
            Field::make('text', 'city', 'Město'),
            Field::make('text', 'phone', 'Telefon'),
            Field::make('text', 'fax', 'Fax'),
            Field::make('text', 'e_mail', 'E-mail'),
            Field::make('text', 'gps', 'GPS'),
        ];
    }

    final public function registerContactFields(): void
    {
        Container::make('post_meta', 'Custom Data')->where('post_type', '=', 'page')->add_fields(
            [
                Field::make('text', 'name', 'Celé jméno'),
                Field::make('text', 'position', 'Pozice'),
                Field::make('text', 'phone', 'Telefon'),
                Field::make('text', 'fax', 'Fax'),
                Field::make('text', 'e_mail', 'E-mail'),
                Field::make('image', 'image', 'Fotografie'),
            ]
        );
    }
}
