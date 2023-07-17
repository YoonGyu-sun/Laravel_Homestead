<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Management extends Model
{
    use HasFactory;
    protected $table = 'managements'; //이 값을 안넣으면 insert management로 들어감
    
        protected $fillable = [
            'user_id', 'title', 'body', 'type'
        ];
        //user_id는 외래키로해서 user와 연동해야할듯/

        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        
    
}
