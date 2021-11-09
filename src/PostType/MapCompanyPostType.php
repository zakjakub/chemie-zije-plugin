<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class MapCompanyPostType
{
    public const POST_TYPE = 'map_company';

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
                'has_archive'         => true,
                'can_export'          => true,
                'exclude_from_search' => false,
                'yarpp_support'       => true,
                'taxonomies'          => [/*'contact_person'*/],
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            ]);
    }
}
