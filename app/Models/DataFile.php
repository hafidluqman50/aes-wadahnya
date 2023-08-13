<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;
use App\Models\User;

class DataFile extends Model
{
    use HasFactory, UuidInsert;

    protected $table      = 'data_file';
    protected $primaryKey = 'id_data_file';
    // public $timestamps    = false;
    protected $guarded    = [];

    public function users()
    {
        return $this->belongsTo(User::class,'id_users');
    }
}
