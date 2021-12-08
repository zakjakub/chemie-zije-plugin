<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class TeachMaterialCategoryPostType
{
    public const POST_TYPE = 'teach_material_cat';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __('teaching_material_categories'),
            'description'         => __('Stránky o kategoriích výukových materiálů'),
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'labels'              => [
                'name'               => __('Kategorie výukových materiálů'),
                'singular_name'      => __('Kategorie výukových materiálů'),
                'menu_name'          => __('Kategorie výukových materiálů'),
                'parent_item_colon'  => __('Nadřazená kategorie výukových materiálů'),
                'all_items'          => __('Všechny kategorie výukových materiálů'),
                'view_item'          => __('Zobrazit Kategorii výukových materiálů'),
                'add_new_item'       => __('Přidat kategorii výukových materiálů'),
                'add_new'            => __('Přidat novou kategorii výukových materiálů'),
                'edit_item'          => __('Upravit kategorii výukových materiálů'),
                'update_item'        => __('Aktualizovat kategorii výukových materiálů'),
                'search_items'       => __('Vyhledat kategorii výukových materiálů'),
                'not_found'          => __('Kategorie výukových materiálů nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných kategoriích výukových materiálů'),
                'name_as_subtitle'   => 'Výukové materiály',
            ],
            'rewrite'             => [
                'slug' => 'kategorie-vyukovych-materialu',
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
            'taxonomies'          => ['teach_mat_cat_type', 'teach_mat_sub_type'],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerPostFields(): void
    {
        self::registerTabsFieldsContainer();
    }

    final public static function registerTabsFieldsContainer(): void
    {
        $tabsFieldsContainer = Container::make('post_meta', 'Náhledové obrázky k záložkám/kategoriím');
        $tabsFieldsContainer->where('post_type', '=', self::POST_TYPE);
        $tabsField = Field::make('complex', 'tab_thumbnails', 'Záložky');
        assert($tabsField instanceof Field\Complex_Field);
        $tabsField->add_fields([
            Field::make('text', 'tab_slug', 'Identifikátor')->set_required(true)->set_width(50),
            Field::make('image', 'tab_thumbnail', 'Náhledový obrázek')->set_required(true)->set_width(50),
        ]);
        $tabsFieldsContainer->add_fields([$tabsField]);
    }
}
