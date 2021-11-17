<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class TeachMaterialPostType
{
    public const POST_TYPE = 'teach_material';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __('teaching_materials'),
            'description'         => __('Jednotlivé výukové materiály'),
            'menu_icon'           => 'dashicons-welcome-learn-more',
            'labels'              => [
                'name'                 => __('Výukové materiály'),
                'singular_name'        => __('Výukový materiál'),
                'menu_name'            => __('Výukové materiály'),
                'parent_item_colon'    => __('Nadřazený výukový materiál'),
                'all_items'            => __('Všechny výukové materiály'),
                'view_item'            => __('Zobrazit výukový materiál'),
                'add_new_item'         => __('Přidat výukový materiál'),
                'add_new'              => __('Přidat nový výukový materiál'),
                'edit_item'            => __('Upravit výukový materiál'),
                'update_item'          => __('Aktualizovat výukový materiál'),
                'search_items'         => __('Vyhledat výukový materiál'),
                'not_found'            => __('Výukový materiál nenalezen'),
                'not_found_in_trash'   => __('Nenalezeno v odstraněných výukových materiálech'),
                'category_as_subtitle' => true,
            ],
            'rewrite'             => [
                'slug' => 'vyukovy-material',
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
        self::registerDocumentsFieldsContainer();
        self::registerSymbolsFieldsContainer();
        self::registerVideoFieldContainer();
        self::registerTabsFieldsContainer();
    }

    final public static function registerDocumentsFieldsContainer(): void
    {
        $documentsContainer = Container::make('post_meta', 'Dokumenty, prezentace a pracovní listy');
        $documentsContainer->where('post_type', '=', self::POST_TYPE);
        $presentationsField = Field::make('complex', 'presentations', 'Prezentace');
        assert($presentationsField instanceof Field\Complex_Field);
        $presentationsField->add_fields([
            Field::make('text', 'document_name', 'Název')->set_required(true)->set_width(50),
            Field::make('file', 'document_file', 'Soubor')->set_required(true)->set_width(50),
        ]);
        $documentsContainer->add_fields([$presentationsField]);
        $handoutsField = Field::make('complex', 'handouts', 'Pracovní listy');
        assert($handoutsField instanceof Field\Complex_Field);
        $handoutsField->add_fields([
            Field::make('text', 'document_name', 'Název')->set_required(true)->set_width(50),
            Field::make('file', 'document_file', 'Soubor')->set_required(true)->set_width(50),
        ]);
        $documentsContainer->add_fields([$handoutsField]);
    }

    final public static function registerSymbolsFieldsContainer(): void
    {
        $symbolsContainer = Container::make('post_meta', 'Piktogramy');
        $symbolsContainer->where('post_type', '=', self::POST_TYPE);
        $difficultySymbolsField = Field::make('complex', 'difficulty_symbols', 'Délka a náročnost (piktogramy)');
        assert($difficultySymbolsField instanceof Field\Complex_Field);
        $difficultySymbolsField->add_fields([
            Field::make('image', 'symbol', 'Piktogram')->set_required(true),
        ]);
        $safetySymbolsField = Field::make('complex', 'safety_symbols', 'Bezpečnost (piktogramy)');
        assert($safetySymbolsField instanceof Field\Complex_Field);
        $safetySymbolsField->add_fields([
            Field::make('image', 'symbol', 'Piktogram')->set_required(true),
        ]);
        $symbolsContainer->add_fields([$safetySymbolsField]);
    }

    final public static function registerVideoFieldContainer(): void
    {
        $documentsContainer = Container::make('post_meta', 'Odkaz na YOuTube video');
        $documentsContainer->where('post_type', '=', self::POST_TYPE);
        $documentsContainer->add_fields([
            Field::make('text', 'youtube_video_url', 'YouTube URL')->set_required(true),
        ]);
    }

    final public static function registerTabsFieldsContainer(): void
    {
        $tabsFieldsContainer = Container::make('post_meta', 'Záložky s obsahem (k videím/pokusům)');
        $tabsFieldsContainer->where('post_type', '=', self::POST_TYPE);
        $tabsField = Field::make('complex', 'tabs', 'Záložky');
        assert($tabsField instanceof Field\Complex_Field);
        $tabsField->add_fields([
            Field::make('text', 'title', 'Název')->set_required(true)->set_width(100),
            Field::make('rich_text', 'content', 'Obsah')->set_required(true)->set_width(100),
        ]);
        $tabsFieldsContainer->add_fields([$tabsField]);
    }
}
