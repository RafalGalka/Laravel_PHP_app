<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeSample extends Model
{
    use HasFactory;
    protected $table = 'take_samples';

    public $timestamps = false;

    public function protocol()
    {
        return $this->belongsTo(ProtocolNumber::class, 'protocol_number', 'protocol_number');
    }

    public function class()
    {
        return $this->belongsTo(StrenghtClass::class, 'compression_class');
    }
}
