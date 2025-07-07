<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\ModuleProfession\Contracts\Data\JobDeskData as DataJobDeskData;

class JobDeskData extends OccupationData implements DataJobDeskData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'JobDesk';
        parent::before($attributes);
    }
}