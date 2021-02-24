<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Zakjakub\ChemieZijePlugin\PostTypes\ChemicalNomenclaturePostType;
use Zakjakub\ChemieZijePlugin\PostTypes\ContactPersonPostType;

class ChemieZijePlugin
{
    public function __construct()
    {
        $this->registerContactPersonPostType();
        $this->registerChemicalNomenclaturePostType();
        // Post types
        add_action('init', [$this, 'registerChemicalCalculationCategoryPost'], 0);
        add_action('init', [$this, 'registerChemicalIndustryMaterialPost'], 0);
        add_action('init', [$this, 'registerIndustrialChemistryFieldPost'], 0);
        add_action('init', [$this, 'registerTeachingMaterialCategoryPost'], 0);
        add_action('init', [$this, 'registerStudyMaterialCategoryPost'], 0);
        // Taxonomies
        add_action('init', [$this, 'registerContactSubDepartmentTaxonomy'], 0);
        add_action('init', [$this, 'registerTeachingMaterialCategoryTypeTaxonomy'], 0);
        // Carbon fields
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerPostFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerIndustryMaterialPostFields']);
    }

    final public function registerContactPersonPostType(): void
    {
        add_action('init', [ContactPersonPostType::class, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [ContactPersonPostType::class, 'registerContactPersonPostFields']);
    }

    final public function registerChemicalNomenclaturePostType(): void
    {
        add_action('init', [ChemicalNomenclaturePostType::class, 'registerPostType'], 0);
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
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes',
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

    final public function registerTeachingMaterialCategoryPost(): void
    {
        $args = [
            'label'               => __('teaching_material_categories'),
            'description'         => __('Stránky o kategoriích výukových materiálů'),
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'labels'              => [
                'name'               => __('Kategorie výukových materiálů'),
                'singular_name'      => __('Kategorie výukových materiálů'),
                'menu_name'          => __('Kategorie výukových materiálů'),
                'parent_item_colon'  => __('Nadřazená kategorie výukových materiálů'),
                'all_items'          => __('Všechny kategorie výukových materiálů'),
                'view_item'          => __('Zobrazit Kategorii výukových materiálů'),
                'add_new_item'       => __('Přidat kategorii výukových materiálů'),
                'add_new'            => __('Přidat novou kategorii výukových materiálů'),
                'edit_item'          => __('Upravit kategorii výukových materiálů'),
                'update_item'        => __('Aktualizovat kategorii výukových materiálů'),
                'search_items'       => __('Vyhledat kategorii výukových materiálů'),
                'not_found'          => __('Kategorie výukových materiálů nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných kategoriích výukových materiálů'),
            ],
            'rewrite'             => [
                'slug' => 'vyukove-materialy',
            ],
            'supports'            => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes',
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
            'taxonomies'          => ['teach_mat_cat_type'],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type('teach_material_cat', $args);
    }

    final public function registerStudyMaterialCategoryPost(): void
    {
        $args = [
            'label'               => __('study_material_categories'),
            'description'         => __('Stránky o kategoriích studijních materiálů'),
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'labels'              => [
                'name'               => __('Kategorie studijních materiálů'),
                'singular_name'      => __('Kategorie studijních materiálů'),
                'menu_name'          => __('Kategorie studijních materiálů'),
                'parent_item_colon'  => __('Nadřazená kategorie studijních materiálů'),
                'all_items'          => __('Všechny kategorie studijních materiálů'),
                'view_item'          => __('Zobrazit Kategorii studijních materiálů'),
                'add_new_item'       => __('Přidat kategorii studijních materiálů'),
                'add_new'            => __('Přidat novou kategorii studijních materiálů'),
                'edit_item'          => __('Upravit kategorii studijních materiálů'),
                'update_item'        => __('Aktualizovat kategorii studijních materiálů'),
                'search_items'       => __('Vyhledat kategorii studijních materiálů'),
                'not_found'          => __('Kategorie studijních materiálů nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných kategoriích studijních materiálů'),
            ],
            'rewrite'             => [
                'slug' => 'studijni-materialy',
            ],
            'supports'            => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes',
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
        register_post_type('study_material_cat', $args);
    }

    final public function registerChemicalIndustryMaterialPost(): void
    {
        $args = [
            'label'               => __('industry_material'),
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
            "rewrite"             => [
                "slug" => "material",
            ],
            'supports'            => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes',
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
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'page-attributes',
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

    final public function registerTeachingMaterialCategoryTypeTaxonomy(): void
    {
        register_taxonomy(
            'teach_mat_cat_type',
            ['teach_material_cat', 'teach_material'],
            [
                'labels'            => [
                    'name'              => _x('Typy výukových materiálů', 'taxonomy general name'),
                    'singular_name'     => _x('Typ výukového materiálu', 'taxonomy singular name'),
                    'search_items'      => __('Hledat typ výukového materiálu'),
                    'all_items'         => __('Všechny typy výukových materiálů'),
                    'parent_item'       => __('Nadřazený typ výukového materiálu'),
                    'parent_item_colon' => __('Nadřazený typ výukového materiálu:'),
                    'edit_item'         => __('Upravit typ výukového materiálu'),
                    'update_item'       => __('Aktualizovat typ výukového materiálu'),
                    'add_new_item'      => __('Přidat nový typ výukového materiálu'),
                    'new_item_name'     => __('Název nového typu výukového materiálu'),
                    'menu_name'         => __('Typy výukových materiálů'),
                ],
                'hierarchical'      => false,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'type'],
                'menu_icon'         => 'dashicons-welcome-learn-more',
            ]
        );
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerContactFields(): void
    {
        $complexField = Field::make('complex', 'contact', 'Kontakt');
        assert($complexField instanceof Field\Complex_Field);
        $complexField->add_fields(
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
        );
        $contactSettings = Container::make('theme_options', 'Kontakt na katedru');
        $contactSettings->add_fields([$complexField]);
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

    final public function registerIndustryMaterialPostFields(): void
    {
        $industryMaterialFields = Container::make('post_meta', 'Nastavení suroviny');
        $industryMaterialFields->where('post_type', '=', 'industry_material');
        $industryMaterialFields->add_fields(
            [
                Field::make('image', 'material_image', 'Obrázek suroviny'),
            ]
        );
    }
}
