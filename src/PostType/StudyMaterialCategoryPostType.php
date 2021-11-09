<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class StudyMaterialCategoryPostType
{
    public const POST_TYPE = 'study_material_cat';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
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
                'name_as_subtitle'   => 'Studijní materiály',
            ],
            'rewrite'             => [
                'slug' => 'kategorie-studijnich-materialu',
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
            'taxonomies'          => [],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }
}
