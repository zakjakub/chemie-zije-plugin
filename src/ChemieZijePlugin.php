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

    final public function registerOptionsFields(): void
    {
        $mainSettings = Container::make('theme_options', 'Nastavení webu');
        $mainSettings->add_fields([Field::make('text', 'example_option_1')]);
        $contactSettings = $this->getContactFieldsGroup();
        assert($contactSettings instanceof Container\Theme_Options_Container);
        $contactSettings->set_page_parent($mainSettings);
        $contactSettings->add_fields(
            [
                Field::make('text', 'crb_facebook_link', __('Facebook Link')),
                Field::make('text', 'crb_twitter_link', __('Twitter Link')),
            ]
        );
    }

    final public function getContactFieldsGroup(): Field\Field
    {
        $contactFields = Field::make('complex', 'contact');
        assert($contactFields instanceof Field\Complex_Field);
        $persons = Field::make('complex', 'persons');
        $persons->add_fields(
            'person',
            [
                Field::make('text', 'name', 'Celé jméno'),
                Field::make('text', 'position', 'Pozice'),
                Field::make('text', 'phone', 'Telefon'),
                Field::make('text', 'fax', 'Fax'),
                Field::make('text', 'eMail', 'E-mail'),
            ],
        );
        $subDepartments = Field::make('complex', 'sub_departments');
        $subDepartments->add_fields(
            'department',
            [
                Field::make('text', 'name', 'Název'),
                $persons,
            ],
        );
        $contactFields->add_fields(
            'address',
            [
                Field::make('text', 'name', 'Název'),
                Field::make('text', 'department', 'Katedra'),
                Field::make('text', 'faculty', 'Fakulta'),
                Field::make('text', 'university', 'Univerzita'),
                Field::make('text', 'street', 'Ulice'),
                Field::make('text', 'houseNumber', 'Číslo popisné')->set_attribute('type', 'number'),
                Field::make('text', 'postalCode', 'Směrovací číslo'),
                Field::make('text', 'city', 'Město'),
                Field::make('text', 'phone', 'Telefon'),
                Field::make('text', 'fax', 'Fax'),
                Field::make('text', 'eMail', 'E-mail'),
                Field::make('text', 'gps', 'GPS'),
                $subDepartments,
            ],
        );

        return $contactFields;
    }
}
