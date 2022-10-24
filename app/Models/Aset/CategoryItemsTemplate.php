<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryItemsTemplate extends Model
{
    use DataLogger;
    use SoftDeletes;
    protected $table = 'category_items_template';
    protected $connection = 'aset';
    protected $fillable = [
        'category_id',
        'items_template_id',
        'users_id',

    ];

    public function category() {
        return $this->belongsTo('App\Models\Aset\Category', 'category_id')->withTrashed();
    }

    public function itemstemplate() {
        return $this->belongsTo('App\Models\Aset\ItemsTemplate', 'items_template_id')->withTrashed();
    }

}
