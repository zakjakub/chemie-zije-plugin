<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class TeachingMaterialCategoryTypeTaxonomy
{
    public const TAXONOMY = 'teach_mat_cat_type';

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(
            self::TAXONOMY,
            ['teach_material_cat', 'teach_material'],
            [
                'labels'            => [
                    'name'              => _x('Typy výukových materiálů', 'taxonomy general name'),
                    'singular_name'     => _x('Typ výukového materiálu', 'taxonomy singular name'),
                    'search_items'      => __('Hledat typ výukového materiálu'),
                    'all_items'         => __('Všechny typy výukových materiálů'),
                    'parent_item'       => __('Nadřazený typ výukového materiálu'),
                    'parent_item_colon' => __('Nadřazený typ výukového materiálu:'),
                    'edit_item'         => __('Upravit typ výukového materiálu'),
                    'update_item'       => __('Aktualizovat typ výukového materiálu'),
                    'add_new_item'      => __('Přidat nový typ výukového materiálu'),
                    'new_item_name'     => __('Název nového typu výukového materiálu'),
                    'menu_name'         => __('Typy výukových materiálů'),
                ],
                'hierarchical'      => false,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'type'],
                'menu_icon'         => 'dashicons-welcome-learn-more',
            ]
        );
    }
}
