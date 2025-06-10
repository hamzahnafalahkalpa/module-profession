<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\ModuleProfession\Contracts\Data\OccupationData as DataOccupationData;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OccupationData extends ProfessionData implements DataOccupationData{
    #[MapInputName('flag')]
    #[MapName('flag')]
    public ?string $flag = Flag::OCCUPATION->value;
}