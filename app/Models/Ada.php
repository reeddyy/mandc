<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ada extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'adas';

    protected $dates = [
        'date_awarded',
        'award_validity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'member_name_id',
        'award_name',
        'date_awarded',
        'award_validity',
        'awarding_body',
        'award_status',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member_name()
    {
        return $this->belongsTo(Membership::class, 'member_name_id');
    }

    public function getDateAwardedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAwardedAttribute($value)
    {
        $this->attributes['date_awarded'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getAwardValidityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAwardValidityAttribute($value)
    {
        $this->attributes['award_validity'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
