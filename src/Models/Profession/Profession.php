<?php

namespace Hanafalah\ModuleProfession\Models\Profession;

use Hanafalah\LaravelSupport\Models\Unicode\Unicode;
use Hanafalah\ModuleProfession\Resources\Profession\{
    ShowProfession, ViewProfession
};

class Profession extends Unicode
{
    protected $table = 'unicodes';

    public function getViewResource(){
        return ViewProfession::class;
    }

    public function getShowResource(){
        return ShowProfession::class;
    }

    public function childs(){
        return $this->hasManyModel($this->getMorphClass(), static::getParentId())->withoutGlobalScopes()->with(['childs']);
    }
}
