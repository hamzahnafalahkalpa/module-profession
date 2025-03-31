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
    protected $table = 'professions';

    protected static function booting(): void{
        static::setFlags(Flag::OCCUPATION->value);
    }

    protected static function booted(): void{
        parent::booted();

        static::creating(function ($query) {
            if (!isset($query->flag)) $query->flag = Flag::OCCUPATION->value;
        });
    }

    public function getViewResource(){
        return ViewOccupation::class;
    }

    public function getShowResource(){
        return ShowOccupation::class;
    }

    public function childs(){
        return $this->hasManyModel(get_class($this), static::getParentId())->where('flag',Flag::OCCUPATION->value)->with(['childs']);
    }
}
