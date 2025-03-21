<?php

namespace App\Auth\Models;

use App\Common\Trait\RouteBindingResolver;
use App\Order\Models\Order;
use App\Product\Models\Product;

use Illuminate\Database\Eloquent\Factories\{HasFactory};
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use RouteBindingResolver;

    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return HasMany<Order, User>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany<Product, User>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
