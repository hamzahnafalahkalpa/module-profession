<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Numeric;

class ProfessionData extends Data{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('parent_id')]
    #[MapName('parent_id')]
    public mixed $parent_id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('flag')]
    #[MapName('flag')]
    #[Numeric]
    #[In(Flag::cases())]
    public ?string $flag = Flag::PROFESSION->value;
}