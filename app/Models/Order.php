<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // กำหนด primary key ของตารางนี้
    protected $primaryKey = 'orderId';

    // ถ้าคุณใช้ชื่อคอลัมน์ที่ไม่ใช่ 'id' Laravel ต้องการให้ระบุว่าไม่ใช่ auto-incrementing
    public $incrementing = true;

    // ถ้าหากคอลัมน์ primary key เป็นประเภทข้อมูลที่ไม่ใช่ integer เช่น string
    protected $keyType = 'int';

    protected $casts = [
        'orderDate' => 'datetime',
    ];
    // สัมพันธ์กับตาราง products
    // Order.php
    public function products()
    {
        return $this->belongsToMany(Products::class, 'order_product', 'order_orderId', 'products_productId')
            ->withPivot('quantity')
            ->withTimestamps();
    }


}
