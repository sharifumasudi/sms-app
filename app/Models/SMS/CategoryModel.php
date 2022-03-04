<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['cate_name', 'cate_description'];
    protected $primaryKey = 'category_id';

    public function sms_receiver()
    {
        return $this->hasMany(ReceiversModel::class);
    }

    public static function displayCategories()
    {
        return self::orderBy('category_id', 'DESC')->get();
    }

    public function createCategory(array $data)
    {
        return self::create($data);
    }
}
