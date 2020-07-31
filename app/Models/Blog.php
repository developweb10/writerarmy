<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = array('slug', 'last_name', 'email');
    protected $table = 'articles';

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function formattedCreatedAt()
    {
        // If more than a month has passed, use the formatted date string
        if ($this->created_at->diffInDays() > 30) {
            return 'Created at ' . $this->created_at->toFormattedDateString();
        }

        // Else get the difference for humans
        else {
            return 'Created ' . $this->created_at->diffForHumans();
        }
    }
}
