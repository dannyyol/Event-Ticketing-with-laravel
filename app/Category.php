<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $fillable = ['name'];
    
    public function events()
    {
      return $this->hasMany(Event::class);
    }

    public function subcategories(){
      return $this->hasMany(Subcategory::class, 'category_id');
    }
   
}
