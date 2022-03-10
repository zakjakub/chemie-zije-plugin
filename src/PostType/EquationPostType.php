<?php
/**
 * @noinspection PhpUnused
 * @noinspection UnknownInspectionInspection
 */

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;
use Zakjakub\ChemieZijePlugin\Taxonomy\EquationCategoryTaxonomy;

class EquationPostType
{
    public const POST_TYPE = 'equation';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => 'equation',
            'description'         => 'Řešené příklady',
            'menu_icon'           => 'dashicons-media-document',
            'labels'              => [
                'name'               => 'Řešený příklad',
                'singular_name'      => 'Řešený příklad',
                'menu_name'          => 'Řešené příklady',
                'parent_item_colon'  => 'Nadřazený řeš. příklad',
                'all_items'          => __('Všechny řeš. příklady'),
                'view_item'          => __('Zobrazit řeš. příklad'),
                'add_new_item'       => __('Přidat řeš. příklad'),
                'add_new'            => __('Přidat nový řeš. příklad'),
                'edit_item'          => __('Upravit řeš. příklad'),
                'update_item'        => __('Aktualizovat řeš. příklad'),
                'search_items'       => __('Vyhledat řeš. příklad'),
                'not_found'          => __('Řeš. příklad nenalezen'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných řeš. příkladech'),
                'name_as_subtitle'   => 'Řešené příklady',
            ],
            'rewrite'             => [
                'slug' => 'reseny-priklad',
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
                EquationCategoryTaxonomy::TAXONOMY,
            ],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerPostFields(): void
    {
        self::registerSolutionFieldContainer();
    }

    final public static function registerSolutionFieldContainer(): void
    {
        $documentsContainer = Container::make('post_meta', 'Příklad');
        $documentsContainer->where('post_type', '=', self::POST_TYPE);
        $documentsContainer->add_fields([
            Field::make('rich_text', 'solution', 'Řešení příkladu'),
            $levelField = Field::make('select', 'level', 'Obtížnost'),
        ]);
        assert($levelField instanceof Field\Select_Field);
        $levelField->set_options([
            '1' => 'Lehká',
            '3' => 'Středně těžká',
            '5' => 'Těžká',
        ]);
    }
}
