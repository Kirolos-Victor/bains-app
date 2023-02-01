<?php

namespace App\Models;

use App\Enums\JobEnum;
use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'applications';
    protected $fillable = [
        'first_name',
        'last_name',
        'job',
        'email',
        'phone',
        'date_of_birth',
        'previous_experience',
        'status'
    ];
    public $timestamps = true;
    protected $casts = [
        'job' => JobEnum::class,
        'status' => StatusEnum::class
    ];

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d/m/Y')
        );
    }

    public function previousExperience(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == 1 ? 'True' : 'False'
        );
    }
}
