<?php

namespace Hanafalah\ModuleProfession\Concerns\Relation;

trait HasProfession
{
    protected $__foreign_key = 'profession_id';

    public function initializeHasProfession()
    {
        $this->mergeFillable([
            $this->__foreign_key
        ]);
    }

    //EIGER SECTION
    public function profession()
    {
        return $this->belongsToModel('Profession');
    }
}
