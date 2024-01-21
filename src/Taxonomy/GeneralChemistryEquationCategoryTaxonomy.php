<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class GeneralChemistryEquationCategoryTaxonomy
{
    public const TAXONOMY = 'gen_chem_cat';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerTaxonomy'], 0);
    }

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(self::TAXONOMY, ['teach_material_cat', 'teach_material'], [
            'labels'            => [
                'name'              => _x('Kategorie obecné chemie', 'taxonomy general name'),
                'singular_name'     => _x('Kategorie obecné chemie', 'taxonomy singular name'),
                'search_items'      => __('Hledat kategorii obecné chemie'),
                'all_items'         => __('Všechny kategorie obecné chemie'),
                'parent_item'       => __('Nadřazená kategorie obecné chemie'),
                'parent_item_colon' => __('Nadřazená kategorie obecné chemie:'),
                'edit_item'         => __('Upravit kategorii obecné chemie'),
                'update_item'       => __('Aktualizovat kategorii obecné chemie'),
                'add_new_item'      => __('Přidat novou kategorii obecné chemie'),
                'new_item_name'     => __('Název nové kategorie obecné chemie'),
                'menu_name'         => __('Kategorie obecné chemie'),
            ],
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'gen_chem_cat'],
            'menu_icon'         => 'dashicons-welcome-learn-more',
            'show_in_rest'      => true,
        ]);
    }
}
