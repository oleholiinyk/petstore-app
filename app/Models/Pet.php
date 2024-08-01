<?php

namespace App\Models;

use App\Enums\PetStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property PetStatus $status
 */
class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => PetStatus::class
    ];
}
