<?php
/**
 * @noinspection PhpUnused
 * @noinspection UnknownInspectionInspection
 */

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;
use Zakjakub\ChemieZijePlugin\Taxonomy\NomenclatureEquationCategoryTaxonomy;

class ChemicalNomenclaturePostType
{
    public const POST_TYPE = 'chem_nomenclature';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_filter('query_vars', [__CLASS__, 'registerQueryVars']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
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
            'show_in_rest'        => true,
            'has_archive'         => true,
            'can_export'          => true,
            'exclude_from_search' => false,
            'yarpp_support'       => true,
            'taxonomies'          => [
                NomenclatureEquationCategoryTaxonomy::TAXONOMY,
            ],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public function registerQueryVars(array $queryVars): array
    {
        $queryVars[] = 'count';
        $queryVars[] = 'level';
        $queryVars[] = 'categories';

        return $queryVars;
    }
}
