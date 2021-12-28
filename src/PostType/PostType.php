<?php

namespace Zakjakub\ChemieZijePlugin\PostType;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class PostType
{
    public const POST_TYPE = 'post';

    final public static function register(): void
    {
        add_action('carbon_fields_register_fields', [__CLASS__, 'registerFields']);
    }

    final public static function registerFields(): void
    {
        $chemicalElementsFields = Container::make('post_meta', 'Přesměrování');
        $chemicalElementsFields->where('post_type', '=', self::POST_TYPE);
        $chemicalElementsFields->add_fields([
            $redirectUrlField = Field::make('text', 'redirect_url', 'URL pro přesměrování'),
        ]);
        $redirectUrlField->set_help_text('Adresa, na kterou bude návštěvník přesměrován při načtení stránky.');
    }
}
