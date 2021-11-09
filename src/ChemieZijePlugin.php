<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalIndustryFieldPostType;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalIndustryMaterialPostType;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalNomenclaturePostType;
use Zakjakub\ChemieZijePlugin\PostType\ContactPersonPostType;
use Zakjakub\ChemieZijePlugin\PostType\EquationCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\MapCompanyPostType;
use Zakjakub\ChemieZijePlugin\PostType\StudyMaterialCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\TeachMaterialCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\TeachMaterialPostType;
use Zakjakub\ChemieZijePlugin\Taxonomy\ContactSubDepartmentTaxonomy;
use Zakjakub\ChemieZijePlugin\Taxonomy\TeachingMaterialCategoryTypeTaxonomy;
use Zakjakub\ChemieZijePlugin\Taxonomy\TeachingMaterialSubTypeTaxonomy;

class ChemieZijePlugin
{
    public function __construct()
    {
        self::registerTaxonomies();
        self::registerPostTypes();
        // Carbon fields
        self::loadAndRegisterCarbonFields();
        add_filter('mce_buttons_2', [__CLASS__, 'addTinyMceButtons']);
    }

    final public static function registerTaxonomies(): void
    {
        ContactSubDepartmentTaxonomy::register();
        TeachingMaterialCategoryTypeTaxonomy::register();
        TeachingMaterialSubTypeTaxonomy::register();
    }

    final public static function registerPostTypes(): void
    {
        ContactPersonPostType::register();
        ChemicalNomenclaturePostType::register();
        TeachMaterialCategoryPostType::register();
        MapCompanyPostType::register();
        StudyMaterialCategoryPostType::register();
        ChemicalIndustryMaterialPostType::register();
        TeachMaterialPostType::register();
        ChemicalIndustryFieldPostType::register();
        EquationCategoryPostType::register();
    }

    final public static function loadAndRegisterCarbonFields(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'loadCarbonFields']);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerPostFields']);
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerContactFields']);
    }

    final public static function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public static function registerContactFields(): void
    {
        $contactSettings = Container::make('theme_options', 'Kontakt na katedru');
        $contactSettings->add_fields([
            Field::make('text', 'contact_name', 'Název'),
            Field::make('text', 'contact_department', 'Katedra'),
            Field::make('text', 'contact_faculty', 'Fakulta'),
            Field::make('text', 'contact_university', 'Univerzita'),
            Field::make('text', 'contact_street', 'Ulice'),
            Field::make('text', 'contact_house_number', 'Číslo popisné')->set_attribute('type', 'number'),
            Field::make('text', 'contact_postal_code', 'Směrovací číslo'),
            Field::make('text', 'contact_city', 'Město'),
            Field::make('text', 'contact_phone', 'Telefon'),
            Field::make('text', 'contact_fax', 'Fax'),
            Field::make('text', 'contact_e_mail', 'E-mail'),
            Field::make('text', 'contact_gps', 'GPS'),
        ]);
    }

    final public static function registerPostFields(): void
    {
        $contactFields = Container::make('post_meta', 'Nastavení stránky');
        $contactFields->add_fields([
            Field::make('image', 'menu_image', 'Obrázek do dlaždice v menu (klipart)'),
        ]);
    }

    final public function addTinyMceButtons(array $buttons): array
    {
        $buttons[] = 'superscript';
        $buttons[] = 'subscript';

        return $buttons;
    }
}
