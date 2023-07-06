<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class User extends Model
{
    use SoftDeletes; // toggle soft deletes
    use Uuid;
    protected $table = 'users';
    protected $fillable = ['email', 'firstname', 'lastname', 'title',  'companyname', 'companyaddress', 'mobile', 'phone', 'socialmedia', 'logo']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public function categories()
    {
        return $this->hasMany('\App\Models\Category', 'user_id');
    }
    public function todos()
    {
        return $this->hasMany('\App\Models\Todo', 'user_id');
    }
}
