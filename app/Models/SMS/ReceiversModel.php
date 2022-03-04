<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiversModel extends Model
{
    use HasFactory;
    protected $table = 'sms_receiver';
    protected $primaryKey = 'sms_receiver_id';
    protected $fillable = ['name','phone','category_id'];

    public function categories()
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function displayReceiver()
    {
        return DB::table('sms_receiver')
                    ->join('categories', 'categories.category_id', '=', 'sms_receiver.category_id')
                    ->select('sms_receiver.*', 'categories.*')
                    ->orderBy('categories.category_id', 'DESC')
                    ->get();
    }

    public function ExportToExcel()
    {
        return DB::table('sms_receiver')
                    ->join('categories', 'categories.category_id', '=', 'sms_receiver.category_id')
                    ->select('sms_receiver.name', 'sms_receiver.phone', 'categories.cate_name')
                    ->get();
    }

    public static function createReceiver(array $data)
    {
        return self::create($data);
    }

    public function displayAllReceivers()
    {
        return DB::table('categories')
        ->join('sms_receiver', 'sms_receiver.category_id', '=', 'categories.category_id')
        ->select('sms_receiver.phone')
        ->get();
    }

    public function displayReceiverByCategory($categoryID)
    {
        return DB::table('categories')
        ->join('sms_receiver', 'sms_receiver.category_id', '=', 'categories.category_id')
        ->select('sms_receiver.phone')
        ->where('categories.category_id', $categoryID)
        ->distinct('sms_receiver.*', 'categories.*')
        ->get();
    }
}
