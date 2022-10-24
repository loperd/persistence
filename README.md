# Persistence
A simple persistence component for use in your laravel projects with support static analyzer generics based on @template annotation.

### How to use it?
```bash
composer require loper/persistence
```

Order.php

```php
<?php

declare(strict_types=1);

namespace YourVendor\YourProjectName\Order\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    
    protected $fillable = [
        ...
        'user_id',
        ...
    ]
    protected $guarded = [...]
} 
```

OrderRepository.php
```php
<?php

declare(strict_types=1);

namespace YourVendor\YourProjectName\Order\Repository;

use Loper\Persistence\EntityNotFoundException;
use Loper\Persistence\BaseRepository;
use YourVendor\YourProjectName\Order\Model\Order;

/**
 * @template-extends BaseRepository<Order> 
 */
final class OrderRepository extends BaseRepository {
    public function getOrderByUserId(string $userId): Order
    {
        return $this->getQueryBuilder()->where('user_id', '=', $userId)->find() 
            ?? EntityNotFoundException::notFoundBy(Order::class, 'user_id', $userId);
    }
} 
```