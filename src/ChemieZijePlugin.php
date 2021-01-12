<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class ChemieZijePlugin
{
    public function __construct()
    {
        // Post types
        add_action('init', [$this, 'registerContactPersonPost'], 0);
        add_action('init', [$this, 'registerChemicalNomenclaturePostType'], 0);
        add_action('init', [$this, 'registerChemicalCalculationCategoryPost'], 0);
        add_action('init', [$this, 'registerChemicalIndustryMaterialPost'], 0);
        add_action('init', [$this, 'registerIndustrialChemistryFieldPost'], 0);
        // Taxonomies
        add_action('init', [$this, 'registerContactSubDepartmentTaxonomy'], 0);
        // Carbon fields
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerPostFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactPersonPostFields']);
    }

    final public function registerContactPersonPost(): void
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
                'not_found'          => __('Osoba nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných osobách'),
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

    final public function registerChemicalNomenclaturePostType(): void
    {
        $args = [
            'label'               => __('chemical_nomenclature'),
            'description'         => __('Stránky o oblastech chemického názvosloví'),
            'menu_icon'           => 'dashicons-media-document',
            'labels'              => [
                'name'               => __('Chemická názvosloví'),
                'singular_name'      => __('Chemické názvosloví'),
                'menu_name'          => __('Chemická názvosloví'),
                'parent_item_colon'  => __('Nadřazené chemické názvosloví'),
                'all_items'          => __('Všechna chemická názvosloví'),
                'view_item'          => __('Zobrazit chemické názvosloví'),
                'add_new_item'       => __('Přidat chemické názvosloví'),
                'add_new'            => __('Přidat nové chemické názvosloví'),
                'edit_item'          => __('Upravit chemické názvosloví'),
                'update_item'        => __('Aktualizovat chemické názvosloví'),
                'search_items'       => __('Vyhledat chemické názvosloví'),
                'not_found'          => __('Chemické názvosloví nenalezeno'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných názvoslovích'),
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
            'taxonomies'          => [/*'contact_person'*/],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('chem_nomenclature', $args);
    }

    final public function registerChemicalCalculationCategoryPost(): void
    {
        $args = [
            'label'               => __('chemical_calculation_categories'),
            'description'         => __('Stránky o kategoriích chemických výpočtů'),
            'menu_icon'           => 'dashicons-calculator',
            'labels'              => [
                'name'               => __('Kategorie chemických výpočtů'),
                'singular_name'      => __('Kategorie chemických výpočtů'),
                'menu_name'          => __('Kategorie chemických výpočtů'),
                'parent_item_colon'  => __('Nadřazená kategorie chemických výpočtů'),
                'all_items'          => __('Všechny kategorie chemických výpočtů'),
                'view_item'          => __('Zobrazit Kategorii chemických výpočtů'),
                'add_new_item'       => __('Přidat kategorii chemických výpočtů'),
                'add_new'            => __('Přidat novou kategorii chemických výpočtů'),
                'edit_item'          => __('Upravit kategorii chemických výpočtů'),
                'update_item'        => __('Aktualizovat kategorii chemických výpočtů'),
                'search_items'       => __('Vyhledat kategorii chemických výpočtů'),
                'not_found'          => __('Kategorie chemických výpočtů nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných kategoriích chemických výpočtů'),
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
            'taxonomies'          => [/*'contact_person'*/],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('calculation_category', $args);
    }

    final public function registerChemicalIndustryMaterialPost(): void
    {
        $args = [
            'label'               => __('chemical_industry_materials'),
            'description'         => __('Jednotlivé suroviny chemického průmyslu'),
            'menu_icon'           => 'dashicons-editor-contract',
            'labels'              => [
                'name'               => __('Suroviny chemického průmyslu'),
                'singular_name'      => __('Surovina chemického průmyslu'),
                'menu_name'          => __('Suroviny chemického průmyslu'),
                'parent_item_colon'  => __('Nadřazená surovina chemického průmyslu'),
                'all_items'          => __('Všechny suroviny chemického průmyslu'),
                'view_item'          => __('Zobrazit surovinu chemického průmyslu'),
                'add_new_item'       => __('Přidat surovinu chemického průmyslu'),
                'add_new'            => __('Přidat novou suroviny chemického průmyslu'),
                'edit_item'          => __('Upravit surovinu chemického průmyslu'),
                'update_item'        => __('Aktualizovat surovinu chemického průmyslu'),
                'search_items'       => __('Vyhledat surovinu chemického průmyslu'),
                'not_found'          => __('Surovina chemického průmyslu nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných surovinách chemického průmyslu'),
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
            'taxonomies'          => [/*'contact_person'*/],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('industry_material', $args);
    }

    final public function registerIndustrialChemistryFieldPost(): void
    {
        $args = [
            'label'               => __('chemical_industry_fields'),
            'description'         => __('Stránky o jednotlivých oblastech průmyslové chemie'),
            'menu_icon'           => 'dashicons-hammer',
            'labels'              => [
                'name'               => __('Oblasti průmyslové chemie'),
                'singular_name'      => __('Oblast průmyslové chemie'),
                'menu_name'          => __('Oblasti průmyslové chemie'),
                'parent_item_colon'  => __('Nadřazená oblast průmyslové chemie'),
                'all_items'          => __('Všechny oblasti průmyslové chemie'),
                'view_item'          => __('Zobrazit oblast průmyslové chemie'),
                'add_new_item'       => __('Přidat oblast průmyslové chemie'),
                'add_new'            => __('Přidat novou oblast průmyslové chemie'),
                'edit_item'          => __('Upravit oblast průmyslové chemie'),
                'update_item'        => __('Aktualizovat oblast průmyslové chemie'),
                'search_items'       => __('Vyhledat oblast průmyslové chemie'),
                'not_found'          => __('Oblast průmyslové chemie nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných oblast průmyslové chemie'),
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
            'taxonomies'          => [/*'contact_person'*/],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('industry_field', $args);
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

    final public function registerContactFields(): void
    {
        $contactSettings = Container::make('theme_options', 'Kontakt na katedru');
        $contactSettings->add_fields(
            [
                Field::make('complex', 'contact', 'Kontakt')->add_fields(
                    'address',
                    'Adresa',
                    [
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
                    ]
                ),
            ]
        );
    }

    final public function registerContactPersonPostFields(): void
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

    final public function registerPostFields(): void
    {
        $contactFields = Container::make('post_meta', 'Nastavení stránky');
        $contactFields->add_fields(
            [
                Field::make('image', 'menu_image', 'Obrázek do dlaždice v menu (klipart)'),
            ]
        );
    }
}
