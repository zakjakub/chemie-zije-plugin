<?php

namespace Zakjakub\ChemieZijePlugin\Taxonomy;

use WP_Error;
use WP_Taxonomy;

class NomenclatureEquationCategoryTaxonomy
{
    public const TAXONOMY = 'nomenclature_cat';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerTaxonomy'], 0);
    }

    final public static function registerTaxonomy(): WP_Error|WP_Taxonomy
    {
        return register_taxonomy(self::TAXONOMY, ['teach_material_cat', 'teach_material'], [
            'labels'            => [
                'name'              => _x('Kategorie názvosloví', 'taxonomy general name'),
                'singular_name'     => _x('Kategorie názvosloví', 'taxonomy singular name'),
                'search_items'      => __('Hledat kategorii názvosloví'),
                'all_items'         => __('Všechny kategorie názvosloví'),
                'parent_item'       => __('Nadřazená kategorie názvosloví'),
                'parent_item_colon' => __('Nadřazená kategorie názvosloví:'),
                'edit_item'         => __('Upravit kategorii názvosloví'),
                'update_item'       => __('Aktualizovat kategorii názvosloví'),
                'add_new_item'      => __('Přidat novou kategorii názvosloví'),
                'new_item_name'     => __('Název nové kategorie názvosloví'),
                'menu_name'         => __('Kategorie názvosloví'),
            ],
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'nomenclat_cat'],
            'menu_icon'         => 'dashicons-welcome-learn-more',
            'show_in_rest'      => true,
        ]);
    }
}
