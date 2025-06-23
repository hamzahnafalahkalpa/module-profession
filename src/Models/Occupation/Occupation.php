<?php

namespace Hanafalah\ModuleProfession\Models\Occupation;

use Hanafalah\ModuleProfession\{
    Models\Profession\Profession,
};
use Hanafalah\ModuleProfession\Resources\Occupation\ShowOccupation;
use Hanafalah\ModuleProfession\Resources\Occupation\ViewOccupation;

class Occupation extends Profession
{
    protected $table = 'unicodes';

    public function getViewResource(){
        return ViewOccupation::class;
    }

    public function getShowResource(){
        return ShowOccupation::class;
    }
}
