<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WP_Error;
use WP_Post_Type;

class ContactPersonPostType
{
    public const POST_TYPE = 'contact_person';

    final public static function register(): void
    {
        add_action('init', [__CLASS__, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
    }

    final public static function registerPostType(): WP_Error|WP_Post_Type
    {
        return register_post_type(self::POST_TYPE, [
            'label'               => __(self::POST_TYPE),
            'description'         => __('Osoby uvedené na stránce s kontakty'),
            'menu_icon'           => 'dashicons-groups',
            'labels'              => [
                'name'               => __('Kontaktní osoby'),
                'singular_name'      => __('Kontaktní osoba'),
                'menu_name'          => __('Kontaktní osoby'),
                'parent_item_colon'  => __('Nadřazená kontaktní osoba'),
                'all_items'          => __('Všechny kontaktní osoby'),
                'view_item'          => __('Zobrazit kontaktní osobu'),
                'add_new_item'       => __('Přidat kontaktní osobu'),
                'add_new'            => __('Přidat novou osobu'),
                'edit_item'          => __('Upravit kontaktní osobu'),
                'update_item'        => __('Aktualizovat kontaktní osobu'),
                'search_items'       => __('Vyhledat kontaktní osobu'),
                'not_found'          => __('Osoba nenalezena'),
                'not_found_in_trash' => __('Nenalezeno v odstraněných osobách'),
            ],
            'rewrite'             => [
                'slug' => 'kontaktni-osoba',
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
            'taxonomies'          => [self::POST_TYPE],
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ]);
    }

    final public static function registerPostFields(): Container\Container
    {
        $contactFields = Container::make('post_meta', 'Údaje o osobě');
        $contactFields->where('post_type', '=', self::POST_TYPE);

        return $contactFields->add_fields([
            Field::make('text', 'position', 'Pozice'),
            Field::make('text', 'phone', 'Telefon'),
            Field::make('text', 'fax', 'Fax'),
            Field::make('text', 'e_mail', 'E-mail'),
            Field::make('image', 'image', 'Fotografie'),
        ]);
    }
}
