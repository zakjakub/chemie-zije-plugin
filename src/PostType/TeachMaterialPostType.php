<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class TeachMaterialPostType
{
    public const POST_TYPE = 'teach_material';

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(
            self::POST_TYPE,
            [
                'label'               => __('teaching_materials'),
                'description'         => __('Jednotlivé výukové materiály'),
                'menu_icon'           => 'dashicons-welcome-learn-more',
                'labels'              => [
                    'name'               => __('Výukové materiály'),
                    'singular_name'      => __('Výukový materiál'),
                    'menu_name'          => __('Výukové materiály'),
                    'parent_item_colon'  => __('Nadřazený výukový materiál'),
                    'all_items'          => __('Všechny výukové materiály'),
                    'view_item'          => __('Zobrazit výukový materiál'),
                    'add_new_item'       => __('Přidat výukový materiál'),
                    'add_new'            => __('Přidat nový výukový materiál'),
                    'edit_item'          => __('Upravit výukový materiál'),
                    'update_item'        => __('Aktualizovat výukový materiál'),
                    'search_items'       => __('Vyhledat výukový materiál'),
                    'not_found'          => __('Výukový materiál nenalezen'),
                    'not_found_in_trash' => __('Nenalezeno v odstraněných výukových materiálech'),
                ],
                'rewrite'             => [
                    'slug' => 'vyukovy-material',
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
                'taxonomies'          => ['teach_mat_cat_type', 'teach_mat_sub_type'],
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            ]
        );
    }
}
