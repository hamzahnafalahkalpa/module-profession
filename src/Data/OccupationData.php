<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\ModuleProfession\Contracts\Data\OccupationData as DataOccupationData;

class OccupationData extends ProfessionData implements DataOccupationData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Occupation';
        parent::before($attributes);
    }
}