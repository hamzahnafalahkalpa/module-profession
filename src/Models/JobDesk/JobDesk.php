<?php

namespace Hanafalah\ModuleProfession\Models\JobDesk;

use Hanafalah\ModuleProfession\{
    Models\Profession\Profession,
    Enums\Profession\Flag
};
use Hanafalah\ModuleProfession\Resources\JobDesk\{
    ViewJobDesk, ShowJobDesk
};

class JobDesk extends Profession
{
    protected $table = 'professions';

    protected static function booting(): void{
        static::setFlags(Flag::JOB_DESK->value);
    }

    protected static function booted(): void{
        parent::booted();

        static::creating(function ($query) {
            if (!isset($query->flag)) $query->flag = Flag::JOB_DESK->value;
        });
    }

    public function getViewResource(){
        return ViewJobDesk::class;
    }

    public function getShowResource(){
        return ShowJobDesk::class;
    }
}
