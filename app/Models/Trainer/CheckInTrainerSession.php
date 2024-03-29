<?php

namespace App\Models\Trainer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckInTrainerSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_session_id',
        'check_in_time',
        'check_out_time',
        'duration',
        'user_id'
    ];

    protected $hidden = [];

    public function trainerSession()
    {
        return $this->belongsTo(TrainerSession::class, 'trainer_session_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
