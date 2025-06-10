<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleProfession\Contracts\Data\ProfessionData as DataProfessionData;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ProfessionData extends Data implements DataProfessionData{
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
    public ?string $flag = Flag::PROFESSION->value;

    #[MapInputName('childs')]
    #[MapName('childs')]
    #[DataCollectionOf(ProfessionData::class)]
    public ?array $childs = [];
}