<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'memberships';

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            if ($model->membership_validity != null) {
                if ($model->membership_validity < Carbon::now()->format('Y-m-d')) {
                    $model->member_status = "Expired";
                } else {
                    $model->member_status = "Active";
                }
            }
        });
    }

    protected $dates = [
        'date_awarded',
        'membership_validity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'member_status',
        'member_reference',
        'member_class',
        'member_name',
        'member_email',
        'date_awarded',
        'membership_validity',
        'awarding_body',
        'training_credits',
        'support_funds',
        'digital_member_card',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateAwardedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAwardedAttribute($value)
    {
        $this->attributes['date_awarded'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMembershipValidityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMembershipValidityAttribute($value)
    {
        $this->attributes['membership_validity'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function adas()
    {
        return $this->hasMany(Ada::class, 'member_reference', 'member_reference');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function updateStatus($membership_validity)
    {
        # code...
    }
}
