<?php

namespace Hanafalah\ModuleProfession\Models\JobDesk;

use Hanafalah\ModuleProfession\Models\Occupation\Occupation;
use Hanafalah\ModuleProfession\Resources\JobDesk\{
    ViewJobDesk, ShowJobDesk
};

class JobDesk extends Occupation
{
    protected $table = 'unicodes';

    public function getViewResource(){
        return ViewJobDesk::class;
    }

    public function getShowResource(){
        return ShowJobDesk::class;
    }
}
