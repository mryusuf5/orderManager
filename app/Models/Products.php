<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Products extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'name',
        'stock',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'id');
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'product_id');
    }
}
