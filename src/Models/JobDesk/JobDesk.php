<?php

namespace Hanafalah\ModuleProfession\Models\JobDesk;

use Hanafalah\ModuleProfession\{
    Enums\Profession\Flag
};
use Hanafalah\ModuleProfession\Models\Occupation\Occupation;
use Hanafalah\ModuleProfession\Resources\JobDesk\{
    ViewJobDesk, ShowJobDesk
};

class JobDesk extends Occupation
{
    protected $table = 'unicodes';

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

    public function childs(){
        return $this->hasManyModel('JobDesk','parent_id')->where('flag',Flag::JOB_DESK->value);
    }
}
