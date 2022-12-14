<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Channel extends Model
{
    use HasFactory;

    protected $table = 'channels';

    protected $fillable =[
        'name',
        'slug'
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

}
