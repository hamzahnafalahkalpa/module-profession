<?php

namespace Hanafalah\ModuleProfession\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModuleProfession\Contracts\Data\ProfessionData as DataProfessionData;

class ProfessionData extends UnicodeData implements DataProfessionData{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Profession';
        parent::before($attributes);
    }
}