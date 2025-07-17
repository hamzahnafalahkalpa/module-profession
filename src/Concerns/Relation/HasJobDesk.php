<?php

namespace Hanafalah\ModuleProfession\Concerns\Relation;

use Hanafalah\ModuleProfession\Enums\Profession\Flag;

trait HasJobDesk
{
    //EIGER SECTION
    public function jobDesk(){
        return $this->hasOneModel('JobDesk','parent_id')->where('flag',Flag::JOB_DESK->value)->with('childs');
    }

    public function jobDesks(){
        return $this->hasManyModel('JobDesk','parent_id')->where('flag',Flag::JOB_DESK->value)->with('childs');
    }
}
