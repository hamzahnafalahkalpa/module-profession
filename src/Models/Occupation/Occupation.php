<?php

namespace Hanafalah\ModuleProfession\Models\Occupation;

use Hanafalah\ModuleProfession\{
    Models\Profession\Profession,
    Enums\Profession\Flag
};
use Hanafalah\ModuleProfession\Resources\Occupation\ShowOccupation;
use Hanafalah\ModuleProfession\Resources\Occupation\ViewOccupation;

class Occupation extends Profession
{
    protected $table = 'unicodes';

    public static function getFlag(): string{
        return Flag::OCCUPATION->value;
    }

    public function getViewResource(){
        return ViewOccupation::class;
    }

    public function getShowResource(){
        return ShowOccupation::class;
    }
}
