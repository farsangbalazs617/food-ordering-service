<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents an order placed by a customer at a restaurant.
 *
 * @property int $customer_id The ID of the customer who placed the order.
 * @property int $restaurant_id The ID of the restaurant where the order was placed.
 * @property string $status The current status of the order.
 *
 * @property \App\Models\User $customer The customer who placed the order.
 * @property \App\Models\Restaurant $restaurant The restaurant where the order was placed.
 * @property \App\Models\OrderItem[] $orderItems The items included in the order.
 * 
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Returns the customer who placed the order.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Returns the restaurant where the order was placed.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    /**
     * Returns the order items associated with this order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
