<?php

namespace App\Models\Store;

use App\Models\Feedback\Comment;
use App\Models\Feedback\Rating;
use App\Models\MultimediaHub\Tag;
use App\Models\Region;
use App\Models\Scopes\StoreScope;
use App\Models\Users\User;
use App\Observers\Store\ProductObserver;
use App\Traits\HasPhoto;
use App\Traits\PushNotify;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, HasPhoto ;

    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 'description',
        'featured','visits_count','is_available','quantity',
        'price', 'compare_price', 'rating', 'status'
        ];


    protected $appends =[];
    public static function booted()
    {
        static::addGlobalScope('store' , new StoreScope());
        static::observe(ProductObserver::class);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'status' => null,

        ], $filters);

        $builder->when($params['search'], function ($builder, $value) {
//            $category_id = Category::query()->where('name', 'like', "%$value%")->first()?->id;
            $builder->where('name', 'like', "%$value%")
                ->orWhere('description', 'like', "%$value%")
                ->orWhere('rating', 'like', "%$value%")
                ->orWhere('quantity', 'like', "%$value%")
                ->orWhere('price', 'like', "%$value%");
//                ->orWhere('category_id', $category_id);
        });

        $builder->when($params['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active')->where('is_available', true);
    }


    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }

    /*
        public function getImagesAttribute()
        {
            $photo = $this->photo()->get();
            if(!$photo)
            {
                return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
            }
            $url = [];
            foreach ($photo as $image) {
                $url[] = Storage::disk('s3')->temporaryUrl($image->src, now()->minutes(120));
            }
            return $url;
        }
    */


    public function ratings() : MorphMany
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function options() : HasMany
    {
        return $this->hasMany(ProductOptions::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getStatusArAttribute()
    {
        switch ($this->status) {
            case 'active':
                return ' نشط';
                break;
            case 'draft':
                return ' مسودة ';
                break;
            case 'archived':
                return 'مؤرشف';
                break;
        }
    }

    public function variants()
    {
        return $this->hasMany(Variant::class,'product_id','id');
    }


    public function shippingAddressCost(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'shipping_region', 'product_id', 'region_id', 'id', 'id')->withPivot(['price']);
    }
    public function getMainImageAttribute()
    {
        $photo = $this->photo()->where('type','main')->first();
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $url = Storage::disk('s3')->temporaryUrl($photo->src, now()->minutes(120));
        return $url;
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($_product){



//        $users = $_product->store->followers->pluck('id')->toArray();
//        $tokens = User::find($users)->whereNotNull('token_notify')->pluck('token_notify')->toArray();

//            $product = Product::find($_product->id);
//            $users = User::whereHas('following', function ($query) use ($product) {
//                     $query->where('store_id', $product->store->id); })->pluck('token_notify')->toArray();

//            $tokens=[];


//             $this->pushNotify($users,  $title= "new-title"  , $body ='new-body');

//            $title = "منتج جديد تمت اضافته " ;
//            $name = $_product->name ;
//            $body  = "تصفح واعرف المزيد عن المنتج ($name)" ;
            // push real time notification
//        $this->pushNotify($tokens , " $title" , "$body");

//        $ids = $product->store->followers()->pluck('user_id') ;
//        foreach ($ids as $id) {
//            $user = User::find($id);
//            $user->notify(new UserNotify($product));
//        }

        });
    }


}

