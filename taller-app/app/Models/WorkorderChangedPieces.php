<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkorderChangedPieces extends Model
{
    use HasFactory;
    protected $fillable = ['workorder_id','piede_id',];

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }
}
