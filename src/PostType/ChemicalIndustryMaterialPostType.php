<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class ChemicalIndustryMaterialPostType
{
    public const POST_TYPE = 'industry_material';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
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
                'name_as_subtitle'   => 'Suroviny chemického průmyslu',
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
            'taxonomies'          => [],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerFields(): void
    {
        $industryMaterialFields = Container::make('post_meta', 'Nastavení suroviny');
        $industryMaterialFields->where('post_type', '=', self::POST_TYPE);
        $complexField = Field::make('complex', 'references', 'Literatura');
        assert($complexField instanceof Field\Complex_Field);
        $complexField->add_fields([
            Field::make('text', 'reference_id', 'Ref. ID')->set_width(15),
            Field::make('text', 'reference_text', 'Zdroj')->set_width(85),
        ]);
        $industryMaterialFields->add_fields([
            Field::make('text', 'alternative_names', 'Alternativní názvy'),
            $complexField,
        ]);
    }
}
