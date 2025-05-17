<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleProfession\Contracts\Data\JobDeskData as DataJobDeskData;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class JobDeskData extends Data implements DataJobDeskData{
    #[MapInputName('flag')]
    #[MapName('flag')]
    public ?string $flag = Flag::JOB_DESK->value;
}