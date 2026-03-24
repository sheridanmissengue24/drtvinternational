<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JobOffer;

class Application extends Model
{
    use HasFactory;
    protected $guarded=['id']; 
    public function offer() { 
        return $this->belongsTo(JobOffer::class, 'job_offer_id'); 
    }
}
