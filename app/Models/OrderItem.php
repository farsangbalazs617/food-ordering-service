<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents an item in an order, including the order details and associated menu item.
 * 
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'special_instructions',
    ];

    
    /**
     * Returns the order associated with this order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Returns the menu item associated with this order item.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
