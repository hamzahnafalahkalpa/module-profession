<?php

namespace Hanafalah\ModuleProfession\Resources\Profession;

use Hanafalah\LaravelSupport\Resources\Unicode\ShowUnicode;

class ShowProfession extends ViewProfession
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [];
        $show = $this->resolveNow(new ShowUnicode($this));
        $arr = $this->mergeArray(parent::toArray($request), $show,$arr);
        return $arr;
    }
}
