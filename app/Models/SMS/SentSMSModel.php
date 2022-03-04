<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SentSMSModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'sentsms_id';
    protected $table = 'sentsms';
    protected $fillable = ['sender_id','receiver_id','sms_description','date_sent'];

    public $timestamps = true;

    public function receiver() // relationship with receivers
    {
        return $this->belongsTo(ReceiversModel::class, 'receiver_id');
    }

    public function saveSentSMS($data): array
    {
        return self::create($data);
    }
    public function displaySentSMS()
    {
        return DB::table('sentsms')
                ->join('users', 'users.id', '=', 'sentsms.sender_id')
                ->join('sms_receiver', 'sms_receiver.sms_receiver_id', '=', 'sentsms.receiver_id')
                ->select('users.fullname', 'sms_receiver.*', 'sentsms.*')
                ->get();
    }
}
