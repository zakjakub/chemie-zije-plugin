<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class ChemicalIndustryMaterialPostType
{
    public const POST_TYPE = 'industry_material';

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(
            self::POST_TYPE,
            [
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
            ]
        );
    }
}
