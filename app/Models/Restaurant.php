<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents a restaurant in the application.
 *
 * This model provides access to the restaurant data, including its name, address, and phone number.
 * It also provides relationships to the restaurant's menus and orders.
 * 
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
 
    /**
     * Returns the menus associated with this restaurant.
     *
     * This method provides access to the menus that belong to the current restaurant instance.
     * The menus are retrieved using an Eloquent hasMany relationship.
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Returns the orders associated with this restaurant.
     *
     * This method provides access to the orders that belong to the current restaurant instance.
     * The orders are retrieved using an Eloquent hasMany relationship, with the restaurant_id
     * foreign key used to link the orders to the restaurant.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurant_id');
    }
}
