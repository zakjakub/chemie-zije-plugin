<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class TeachingMaterialSubTypeTaxonomy
{
    public const TAXONOMY = 'teach_mat_sub_type';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerTaxonomy'], 0);
    }

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(self::TAXONOMY, ['teach_material_cat', 'teach_material'], [
            'labels'            => [
                'name'              => _x('Podtypy výukových materiálů', 'taxonomy general name'),
                'singular_name'     => _x('Podtyp výukového materiálu', 'taxonomy singular name'),
                'search_items'      => __('Hledat podtyp výukového materiálu'),
                'all_items'         => __('Všechny podtypy výukových materiálů'),
                'parent_item'       => __('Nadřazený podtyp výukového materiálu'),
                'parent_item_colon' => __('Nadřazený podtyp výukového materiálu:'),
                'edit_item'         => __('Upravit podtyp výukového materiálu'),
                'update_item'       => __('Aktualizovat podtyp výukového materiálu'),
                'add_new_item'      => __('Přidat nový podtyp výukového materiálu'),
                'new_item_name'     => __('Název nového podtypu výukového materiálu'),
                'menu_name'         => __('Podtypy výukových materiálů'),
            ],
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'subtype'],
            'menu_icon'         => 'dashicons-welcome-learn-more',
        ]);
    }
}
