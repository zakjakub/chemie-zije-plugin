<?php

namespace Zakjakub\ChemieZijePlugin;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
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
    }

    final public function loadCarbonFields(): void
    {
        Carbon_Fields::boot();
    }

    final public function registerContactFields(): void
    {
        $contactSettings = Container::make('theme_options', 'Kontakt na katedru');
        $contactSettings->add_fields([
            Field::make('text', 'name', 'Název'),
            Field::make('text', 'department', 'Katedra'),
            Field::make('text', 'faculty', 'Fakulta'),
            Field::make('text', 'university', 'Univerzita'),
            Field::make('text', 'street', 'Ulice'),
            Field::make('text', 'house_number', 'Číslo popisné')->set_attribute('type', 'number'),
            Field::make('text', 'postal_code', 'Směrovací číslo'),
            Field::make('text', 'city', 'Město'),
            Field::make('text', 'phone', 'Telefon'),
            Field::make('text', 'fax', 'Fax'),
            Field::make('text', 'e_mail', 'E-mail'),
            Field::make('text', 'gps', 'GPS'),
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
}
