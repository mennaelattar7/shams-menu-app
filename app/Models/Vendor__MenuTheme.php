<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor__MenuTheme extends Model
{
    protected $table = "vendor___menu_themes";

    public function menu_theme_details()
    {
        return $this->hasOne(Vendor__MenuThemeDetail::class,'menu_theme_id','id');
    }
}
