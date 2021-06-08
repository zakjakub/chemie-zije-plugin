<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalCalculationCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalIndustryFieldPostType;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalIndustryMaterialPostType;
use Zakjakub\ChemieZijePlugin\PostType\ChemicalNomenclaturePostType;
use Zakjakub\ChemieZijePlugin\PostType\ContactPersonPostType;
use Zakjakub\ChemieZijePlugin\PostType\StudyMaterialCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\TeachMaterialCategoryPostType;
use Zakjakub\ChemieZijePlugin\PostType\TeachMaterialPostType;
use Zakjakub\ChemieZijePlugin\Taxonomy\ContactSubDepartmentTaxonomy;
use Zakjakub\ChemieZijePlugin\Taxonomy\TeachingMaterialCategoryTypeTaxonomy;

class ChemieZijePlugin
{
    public function __construct()
    {
        $this->registerContactPersonPostType();
        $this->registerChemicalNomenclaturePostType();
        $this->registerChemicalCalculationCategoryPost();
        $this->registerTeachingMaterialCategoryPost();
        $this->registerTeachingMaterialPost();
        $this->registerStudyMaterialCategoryPost();
        $this->registerChemicalIndustryMaterialPost();
        $this->registerIndustrialChemistryFieldPost();
        $this->registerContactSubDepartmentTaxonomy();
        $this->registerTeachingMaterialCategoryTypeTaxonomy();
        // Carbon fields
        add_action('after_setup_theme', [$this, 'loadCarbonFields']);
        $this->registerCarbonFields();
    }

    final public function registerContactPersonPostType(): void
    {
        add_action('init', [ContactPersonPostType::class, 'registerPostType'], 0);
        add_action('carbon_fields_register_fields', [ContactPersonPostType::class, 'registerContactPersonPostFields']);
    }

    final public function registerChemicalNomenclaturePostType(): void
    {
        add_action('init', [ChemicalNomenclaturePostType::class, 'registerPostType'], 0);
    }

    final public function registerChemicalCalculationCategoryPost(): void
    {
        add_action('init', [ChemicalNomenclaturePostType::class, 'registerPostType'], 0);
    }

    final public function registerTeachingMaterialCategoryPost(): void
    {
        add_action('init', [TeachMaterialCategoryPostType::class, 'registerPostType'], 0);
    }

    final public function registerTeachingMaterialPost(): void
    {
        add_action('init', [TeachMaterialPostType::class, 'registerPostType'], 0);
    }

    final public function registerStudyMaterialCategoryPost(): void
    {
        add_action('init', [StudyMaterialCategoryPostType::class, 'registerPostType'], 0);
    }

    final public function registerChemicalIndustryMaterialPost(): void
    {
        add_action('init', [ChemicalIndustryMaterialPostType::class, 'registerPostType'], 0);
    }

    final public function registerIndustrialChemistryFieldPost(): void
    {
        add_action('init', [ChemicalIndustryFieldPostType::class, 'registerPostType'], 0);
    }

    final public function registerContactSubDepartmentTaxonomy(): void
    {
        add_action('init', [ContactSubDepartmentTaxonomy::class, 'registerTaxonomy'], 0);
    }

    final public function registerTeachingMaterialCategoryTypeTaxonomy(): void
    {
        add_action('init', [TeachingMaterialCategoryTypeTaxonomy::class, 'registerTaxonomy'], 0);
    }

    final public function registerCarbonFields(): void
    {
        add_action('carbon_fields_register_fields', [$this, 'registerPostFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerContactFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerIndustryMaterialPostFields']);
        add_action('carbon_fields_register_fields', [$this, 'registerChemicalCalculationPostFields']);
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerContactFields(): void
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

    final public function registerPostFields(): void
    {
        $contactFields = Container::make('post_meta', 'Nastavení stránky');
        $contactFields->add_fields(
            [
                Field::make('image', 'menu_image', 'Obrázek do dlaždice v menu (klipart)'),
            ]
        );
    }

    final public function registerIndustryMaterialPostFields(): void
    {
        $industryMaterialFields = Container::make('post_meta', 'Nastavení suroviny');
        $industryMaterialFields->where('post_type', '=', 'industry_material');
        $industryMaterialFields->add_fields(
            [
                Field::make('image', 'material_image', 'Obrázek suroviny'),
            ]
        );
    }

    final public function registerChemicalCalculationPostFields(): void
    {
        $industryMaterialFields = Container::make('post_meta', 'Řešené příklady');
        $industryMaterialFields->where('post_type', '=', ChemicalCalculationCategoryPostType::POST_TYPE);
        $complexField = Field::make('complex', 'solved_calculation', 'Řešený příklad');
        assert($complexField instanceof Field\Complex_Field);
        $complexField->add_fields(
            [
                Field::make('rich_text', 'solved_calculation', 'Zadání'),
                Field::make('rich_text', 'solved_calculation', 'Řešení'),
            ]
        );
        $industryMaterialFields->add_fields([$complexField]);
    }
}
