<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class TeachMaterialCategoryPostType
{
    public const POST_TYPE = 'teach_material_cat';

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(
            self::POST_TYPE,
            [
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
            ]
        );
    }
}
