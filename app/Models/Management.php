<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;  // 라라벨 9버전 Scout, phpartisan 설치


class Management extends Model
{
    use HasFactory;
    use Searchable;
    
    protected $fillable = [
        'user_id', 'title', 'body', 'type'
    ]; // 그냥 DB 호출
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class); 
    }    
    protected $table = 'managements'; // index.blade.php에서  count개수를 구하기 위해 auth와 managemets를 따로 불러옴
    
}
