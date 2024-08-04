<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents a menu item associated with a restaurant.
 *
 * @property int $restaurant_id The ID of the restaurant this menu item belongs to.
 * @property string $name The name of the menu item.
 * @property float $price The price of the menu item.
 *
 * @property-read \App\Models\Restaurant $restaurant The restaurant this menu item belongs to.
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $orderItems The order items associated with this menu item.
 * 
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'name',
        'price',
    ];

    
    /**
     * Gets the restaurant that this menu item belongs to.
     *
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Gets the order items associated with this menu item.
     *
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
