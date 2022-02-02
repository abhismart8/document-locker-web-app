<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'uploads';

    protected $hidden = [
        //
    ];

    /**
     *
     * fillable properties
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'type',
        'path',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function scopeUsers($query, $userId)
    {
        return $query->where('user_id',$userId);
    }

    public function scopeSorting($query, $sort)
    {
        if($sort){
            if($sort[1]=='asc'){
                return $query->orderBy($sort[0]);
            }else{
                return $query->orderByDesc($sort[0]);
            }
        }else{
            return $query;
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
