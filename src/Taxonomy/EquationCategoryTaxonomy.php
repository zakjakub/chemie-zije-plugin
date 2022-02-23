<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class EquationCategoryTaxonomy
{
    public const TAXONOMY = 'equation_cat';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerTaxonomy'], 0);
    }

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(self::TAXONOMY, ['teach_material_cat', 'teach_material', 'equation_category'], [
            'labels'            => [
                'name'              => _x('Kategorie výpočtů', 'taxonomy general name'),
                'singular_name'     => _x('Kategorie výpočtů', 'taxonomy singular name'),
                'search_items'      => __('Hledat kategorii výpočtů'),
                'all_items'         => __('Všechny kategorie výpočtů'),
                'parent_item'       => __('Nadřazená kategorie výpočtů'),
                'parent_item_colon' => __('Nadřazená kategorie výpočtů:'),
                'edit_item'         => __('Upravit kategorii výpočtů'),
                'update_item'       => __('Aktualizovat kategorii výpočtů'),
                'add_new_item'      => __('Přidat novou kategorii výpočtů'),
                'new_item_name'     => __('Název nové kategorie výpočtů'),
                'menu_name'         => __('Kategorie výpočtů'),
            ],
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'equation_cat'],
            'menu_icon'         => 'dashicons-welcome-learn-more',
            'show_in_rest'      => true,
        ]);
    }
}
