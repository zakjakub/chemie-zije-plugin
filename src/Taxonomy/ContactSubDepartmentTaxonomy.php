<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class ContactSubDepartmentTaxonomy
{
    public const TAXONOMY = 'sub_department';

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(
            self::TAXONOMY,
            ['contact_person'],
            [
                'labels'            => [
                    'name'              => _x('Oddělení', 'taxonomy general name'),
                    'singular_name'     => _x('Oddělení', 'taxonomy singular name'),
                    'search_items'      => __('Hledat oddělení'),
                    'all_items'         => __('Všechna oddělení'),
                    'parent_item'       => __('Nadřazené oddělení'),
                    'parent_item_colon' => __('Nadřazené oddělení:'),
                    'edit_item'         => __('Upravit oddělení'),
                    'update_item'       => __('Aktualizovat oddělení'),
                    'add_new_item'      => __('Přidat nové oddělení'),
                    'new_item_name'     => __('Název nového oddělení'),
                    'menu_name'         => __('Oddělení'),
                ],
                'hierarchical'      => false,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'type'],
                'menu_icon'         => 'dashicons-groups',
            ]
        );
    }
}
