<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    /**
     * Атрибуты, которые можно назначать массово.
     *	
     * @var array
     */
    protected $fillable = [
        'full_name', 'price','serial_number','inventory_number','storage','created_at'
    ];
}