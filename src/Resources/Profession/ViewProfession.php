<?php

namespace Hanafalah\ModuleProfession\Resources\Profession;

use Hanafalah\LaravelSupport\Resources\Unicode\ViewUnicode;

class ViewProfession extends ViewUnicode
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [];
        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
