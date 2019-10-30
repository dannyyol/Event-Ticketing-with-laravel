<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    protected $table = 'subcategories';
    protected $fillable = ['title', 'category_id'];

    public function categories()
    {
      return $this->belongsTo(Category::class, 'category_id');
    }

    public function events()
    {
      return $this->hasMany(Event::class, 'subcategory_id');
    }
}
