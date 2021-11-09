<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class ChemicalIndustryFieldPostType
{
    public const POST_TYPE = 'industry_field';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
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
                'name_as_subtitle'   => 'Průmyslová chemie',
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
