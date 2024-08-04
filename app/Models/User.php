<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Represents a user of the application.
 *
 * This class extends the Authenticatable class from the Illuminate\Foundation\Auth\User namespace,
 * which provides the basic functionality for user authentication.
 *
 * @author Farsang Balázs <farsangbalazs617@gmail.com>
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns the orders associated with the user.
     *
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
