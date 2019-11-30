<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property string $start_time
 * @property text $venue
*/
class Event extends Model
{
    use SoftDeletes, LikableTrait;

    protected $fillable = ['title', 'description', 'start_time', 'venue', 'photo', 'category_id','subcategory_id'];
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tickets()
    {
      return $this->hasOne(Ticket::class);
    }

    public function subcategories()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    
}
