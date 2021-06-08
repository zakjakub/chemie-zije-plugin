<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class ChemicalCalculationCategoryPostType
{
    public const POST_TYPE = 'equation_category';

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(
            self::POST_TYPE,
            [
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
            ]
        );
    }
}
