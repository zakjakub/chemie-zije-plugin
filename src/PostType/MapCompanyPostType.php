<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class MapCompanyPostType
{
    public const POST_TYPE = 'map_company';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __('map_company'),
            'description'         => __('Chemické podniky'),
            'menu_icon'           => 'dashicons-building',
            'labels'              => [
                'name'               => __('Chemické podniky'),
                'singular_name'      => __('Chemický podnik'),
                'menu_name'          => __('Chemické podniky'),
                'parent_item_colon'  => __('Nadřazený chemický podnik'),
                'all_items'          => __('Všechny chemické podniky'),
                'view_item'          => __('Zobrazit chemický podnik'),
                'add_new_item'       => __('Přidat chemický podnik'),
                'add_new'            => __('Přidat nový chemický podnik'),
                'edit_item'          => __('Upravit chemický podnik'),
                'update_item'        => __('Aktualizovat chemický podnik'),
                'search_items'       => __('Vyhledat chemický podnik'),
                'not_found'          => __('Chemický podnik nenalezen'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných chemických podnicích'),
                'name_as_subtitle'   => 'Chemické podniky',
            ],
            "rewrite"             => [
                "slug" => "podnik",
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
            'show_in_rest'        => true,
            'has_archive'         => true,
            'can_export'          => true,
            'exclude_from_search' => false,
            'yarpp_support'       => true,
            'taxonomies'          => [/*'contact_person'*/],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerPostFields(): void
    {
        $mapCompanyFields = Container::make('post_meta', 'Informace o podniku');
        $mapCompanyFields->where('post_type', '=', self::POST_TYPE);
        $mapCompanyFields->add_fields([
            Field::make('text', 'company_url', 'URL')->set_width(27),
            Field::make('text', 'company_phone', 'Telefon')->set_width(27),
            Field::make('text', 'company_email', 'E-mail')->set_width(27),
            Field::make('image', 'company_logo', 'Logo')->set_required(true)->set_width(19),
        ]);
        //
        // Activities / oblasti průmyslu
        $activityFields = Container::make('post_meta', 'Oblasti průmyslu');
        $activityFields->where('post_type', '=', self::POST_TYPE);
        $activityField = Field::make('complex', 'activities', 'Oblasti průmyslu');
        assert($activityField instanceof Field\Complex_Field);
        $activityField->add_fields([
            Field::make('text', 'activity_name', 'Název')->set_required(true),
            Field::make('text', 'activity_description', 'Popis')->set_required(true),
        ]);
        $activityFields->add_fields([$activityField]);
        //
        // Locations / provozovny
        $locationFields = Container::make('post_meta', 'Provozovny');
        $locationFields->where('post_type', '=', self::POST_TYPE);
        $locationField = Field::make('complex', 'locations', 'Provozovny');
        assert($locationField instanceof Field\Complex_Field);
        $locationField->add_fields([
            Field::make('text', 'location_name', 'Název')->set_required(true)->set_width(25),
            Field::make('text', 'location_address', 'Adresa')->set_required(true)->set_width(35),
            Field::make('text', 'location_latitude', 'Zeměpisná šířka')->set_required(true)->set_width(20),
            Field::make('text', 'location_longitude', 'Zeměpisná délka')->set_required(true)->set_width(20),
        ]);
        $locationFields->add_fields([$locationField]);
        //
        // Documents / pracovní listy
        $documentFields = Container::make('post_meta', 'Dokumenty a pracovní listy');
        $documentFields->where('post_type', '=', self::POST_TYPE);
        $documentField = Field::make('complex', 'documents', 'Dokumenty a pracovní listy');
        assert($documentField instanceof Field\Complex_Field);
        $documentField->add_fields([
            Field::make('text', 'document_name', 'Název')->set_required(true)->set_width(50),
            Field::make('file', 'document_file', 'Soubor')->set_required(true)->set_width(50),
        ]);
        $documentFields->add_fields([$documentField]);
    }
}
