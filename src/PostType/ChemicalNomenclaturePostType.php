<?php
/**
 * @noinspection PhpUnused
 * @noinspection UnknownInspectionInspection
 */

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;

class ChemicalNomenclaturePostType
{
    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type('chem_nomenclature', [
                'label'               => __('chemical_nomenclature'),
                'description'         => __('Stránky o oblastech chemického názvosloví'),
                'menu_icon'           => 'dashicons-media-document',
                'labels'              => [
                    'name'               => __('Chemická názvosloví'),
                    'singular_name'      => __('Chemické názvosloví'),
                    'menu_name'          => __('Chemická názvosloví'),
                    'parent_item_colon'  => __('Nadřazené chemické názvosloví'),
                    'all_items'          => __('Všechna chemická názvosloví'),
                    'view_item'          => __('Zobrazit chemické názvosloví'),
                    'add_new_item'       => __('Přidat chemické názvosloví'),
                    'add_new'            => __('Přidat nové chemické názvosloví'),
                    'edit_item'          => __('Upravit chemické názvosloví'),
                    'update_item'        => __('Aktualizovat chemické názvosloví'),
                    'search_items'       => __('Vyhledat chemické názvosloví'),
                    'not_found'          => __('Chemické názvosloví nenalezeno'),
                    'not_found_in_trash' => __('Nenalezeno v odstraněných názvoslovích'),
                    'name_as_subtitle'   => 'Chemická názvosloví',
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
}
