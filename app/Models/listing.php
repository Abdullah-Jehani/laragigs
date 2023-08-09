<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listing extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'user_id' , 'tags' , 'company' , 'location' , 'email' , 'website' , 'description'];
    // this function used to filter the request by checking for a match in DB 
    // the array filters is the request from the user and inside it is the tah the user want to search for
    // the query is the sql query the will check for the user request in the DB

    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) {
            // if the user request is not empty then we will check for a match in the DB
            $query->where('tags', 'like', '%' . request('tag') . '%');
             
        }
        if ($filters['search'] ?? false) {
            // if the user request is not empty then we will check for a match in the DB
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orwhere('description', 'like', '%' . request('search') . '%')
            ->orwhere('tags', 'like', '%' . request('search') . '%')
            ->orwhere('tags', 'like', '%' . request('search') . '%')
            ->orwhere('company', 'like', '%' . request('search') . '%')
            ->orwhere('location', 'like', '%' . request('search') . '%')

            ;
    }
    }
    public function user() {
        return $this->belongsTo(user::class , 'user-id');
    }
}