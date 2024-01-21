<?php
/**
 * @noinspection PhpUnused
 * @noinspection UnknownInspectionInspection
 */

namespace Zakjakub\ChemieZijePlugin\PostType;

use WP_Error;
use WP_Post_Type;
use Zakjakub\ChemieZijePlugin\Taxonomy\GeneralChemistryEquationCategoryTaxonomy;
use Zakjakub\ChemieZijePlugin\Taxonomy\NomenclatureEquationCategoryTaxonomy;

class GeneralChemistryPostType
{
    public const POST_TYPE = 'general_chemistry';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_filter('query_vars', [__CLASS__, 'registerQueryVars']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __('general_chemistry'),
            'description'         => __('Stránky o oblastech obecné chemie'),
            'menu_icon'           => 'dashicons-media-document',
            'labels'              => [
                'name'               => __('Oblast obecné chemie'),
                'singular_name'      => __('Oblast obecné chemie'),
                'menu_name'          => __('Oblast obecné chemie'),
                'parent_item_colon'  => __('Nadřazená oblast obecné chemie'),
                'all_items'          => __('Všechny oblasti obecné chemie'),
                'view_item'          => __('Zobrazit oblast obecné chemie'),
                'add_new_item'       => __('Přidat oblast obecné chemie'),
                'add_new'            => __('Přidat novou oblast obecné chemie'),
                'edit_item'          => __('Upravit oblast obecné chemie'),
                'update_item'        => __('Aktualizovat oblast obecné chemie'),
                'search_items'       => __('Vyhledat oblast obecné chemie'),
                'not_found'          => __('Oblast obecné chemie nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných oblastech obecné chemie'),
                'name_as_subtitle'   => 'Oblasti obecné chemie',
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
                GeneralChemistryEquationCategoryTaxonomy::TAXONOMY,
            ],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerQueryVars(array $queryVars): array
    {
        $queryVars[] = 'count';
        $queryVars[] = 'level';
        $queryVars[] = 'categories';

        return $queryVars;
    }
}
