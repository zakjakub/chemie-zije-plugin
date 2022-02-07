<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class ChemicalElementPostType
{
    public const POST_TYPE = 'chemical_element';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __('chemical_element'),
            'description'         => __('Chemické prvky'),
            'menu_icon'           => 'dashicons-editor-contract',
            'labels'              => [
                'name'               => __('Chemické prvky'),
                'singular_name'      => __('Chemický prvek'),
                'menu_name'          => __('Chemické prvky'),
                'parent_item_colon'  => __('Nadřazený prvek'),
                'all_items'          => __('Všechny chemické prvky'),
                'view_item'          => __('Zobrazit chemický prvek'),
                'add_new_item'       => __('Přidat chemický prvek'),
                'add_new'            => __('Přidat nový chemický prvek'),
                'edit_item'          => __('Upravit chemický prvek'),
                'update_item'        => __('Aktualizovat chemický prvek'),
                'search_items'       => __('Vyhledat chemický prvek'),
                'not_found'          => __('Chemický prvek nenalezen'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných prvcích'),
                'name_as_subtitle'   => 'Chemické prvky',
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
            'hierarchical'        => true,
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

    final public static function registerFields(): void
    {
        $chemicalElementsFields = Container::make('post_meta', 'Nastavení chemického prvku');
        $chemicalElementsFields->where('post_type', '=', self::POST_TYPE);
        $chemicalElementsFields->add_fields([
            $protonNumber = Field::make('text', 'proton_number', 'Protonové číslo'),
        ]);
        $protonNumber->set_attribute('type', 'number');
        $protonNumber->set_attribute('min', 1)->set_attribute('max', 118);
    }
}
