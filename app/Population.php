<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $table = 'populations';

    protected $fillable = [
        'male',
        'female',
        'deaths',
        'births',
        'islam',
        'christian',
        'catholic',
        'hindu',
        'buddha',
        'confucianism',
        'employed',
        'unemployed',
        'housewife',
        'student',
        'migration_in',
        'migration_out'
    ];
}