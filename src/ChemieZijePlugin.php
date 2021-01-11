<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ChemieZijePlugin
{
    public function __construct()
    {
        add_action('init', [$this, 'registerCustomPostType'], 0);
        add_action('init', [$this, 'registerContactSubDepartmentTaxonomy'], 0);
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerOptionsFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactFields']);
    }

    final public function registerCustomPostType(): void
    {
        $args = [
            'label'               => __('contact_person'),
            'description'         => __('Osoby uvedené na stránce s kontakty'),
            'menu_icon'           => 'dashicons-groups',
            'labels'              => [
                'name'               => __('Kontaktní osoby'),
                'singular_name'      => __('Kontaktní osoba'),
                'menu_name'          => __('Kontaktní osoby'),
                'parent_item_colon'  => __('Nadřazená kontaktní osoba'),
                'all_items'          => __('Všechny kontaktní osoby'),
                'view_item'          => __('Zobrazit kontaktní osobu'),
                'add_new_item'       => __('Přidat kontaktní osobu'),
                'add_new'            => __('Přidat novou osobu'),
                'edit_item'          => __('Upravit kontaktní osobu'),
                'update_item'        => __('Aktualizovat kontaktní osobu'),
                'search_items'       => __('Vyhledat kontaktní osobu'),
                'not_found'          => __('Nenalezeno'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných'),
            ],
            'supports'            => [
                'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
                'revisions',
                'custom-fields',
            ],
            'public'              => true,
            'hierarchical'        => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'has_archive'         => true,
            'can_export'          => true,
            'exclude_from_search' => false,
            'yarpp_support'       => true,
            'taxonomies'          => ['contact_person'],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('contact_person', $args);
    }

    final public function registerContactSubDepartmentTaxonomy(): void
    {
        register_taxonomy(
            'sub_department',
            ['contact_person'],
            [
                'labels'            => [
                    'name'              => _x('Oddělení', 'taxonomy general name'),
                    'singular_name'     => _x('Oddělení', 'taxonomy singular name'),
                    'search_items'      => __('Hledat oddělení'),
                    'all_items'         => __('Všechna oddělení'),
                    'parent_item'       => __('Nadřazené oddělení'),
                    'parent_item_colon' => __('Nadřazené oddělení:'),
                    'edit_item'         => __('Upravit oddělení'),
                    'update_item'       => __('Aktualizovat oddělení'),
                    'add_new_item'      => __('Přidat nové oddělení'),
                    'new_item_name'     => __('Název nového oddělení'),
                    'menu_name'         => __('Oddělení'),
                ],
                'hierarchical'      => false,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'type'],
                'menu_icon'         => 'dashicons-groups',
            ]
        );
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerOptionsFields(): void
    {
        $contactSettings = Container::make('theme_options', 'Kontakt na katedru');
        $contactSettings->add_fields(
            [
                Field::make('complex', 'contact', 'Kontakt')->add_fields('address', 'Adresa', [
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
                ])
            ]
        );
    }

    final public function registerContactFields(): void
    {
        $contactFields = Container::make('post_meta', 'Údaje o osobě');
        $contactFields->where('post_type', '=', 'contact_person');
        $contactFields->add_fields(
            [
                Field::make('text', 'position', 'Pozice'),
                Field::make('text', 'phone', 'Telefon'),
                Field::make('text', 'fax', 'Fax'),
                Field::make('text', 'e_mail', 'E-mail'),
                Field::make('image', 'image', 'Fotografie'),
            ]
        );
    }
}
