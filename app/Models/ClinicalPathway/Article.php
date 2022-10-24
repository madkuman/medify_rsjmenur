<?php

namespace App\Models\ClinicalPathway;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use DataLogger;
    use SoftDeletes;

    protected $connection = 'clinical_pathway';
    protected $table = 'articles';
    protected $fillable = ['icd10_id', 'user_id', 'title', 'content'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function icd10()
    {
        return $this->belongsTo('App\Models\Kasus\ICD10')->withTrashed();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
