<?php

namespace App\Services\Store\Product;

use App\Helpers\PhotoUpload;
use App\Models\Store\Attribute;

class OptionsService
{
    public static function createOptions($params, $product)
    {
        if (array_key_exists('options', $params) && $params['options']) {
            foreach ($params['options'] as $option) {
                $attribute = Attribute::firstOrCreate(['name' => $option['attribute']]);
                foreach ($option['options_value'] as $variant) {
                    if (is_file($variant['options_value_photo'])) {
                        $file = $variant['options_value_photo'];
                        $photo_obj['photo_slug'] = $file->getClientOriginalName();
                        $photo_obj['photo'] = PhotoUpload::upload($file);
                        $product->storeImage($photo_obj['photo'],  $photo_obj['photo_slug'], 'variant_photo');
                    }
                    $variant =  $product->variants()->create([
                        'name' => $variant['options_value_value'],
                        'price' => $variant['options_value_price']
                    ]);
                    $variant->attributes()->sync($attribute->id);
                }
            }
        }
    }


    public static function editOptions($params, $product)
    {
        if (array_key_exists('options', $params) && $params['options']) {
            foreach ($params['options'] as $option) {
                $attribute = Attribute::firstOrCreate(['name' => $option['attribute']]);
                foreach ($option['options_value'] as $variant) {
                    if (is_file($variant['options_value_photo'])) {
                        $variant->deleteImageByType('variant_photo');
                        $file = $variant['options_value_photo'];
                        $photo_obj['photo_slug'] = $file->getClientOriginalName();
                        $photo_obj['photo'] = PhotoUpload::upload($file);
                        $product->storeImage($photo_obj['photo'],  $photo_obj['photo_slug'], 'variant_photo');
                    }
                    $variant =  $product->variants()->create([
                        'name' => $variant['options_value_value'],
                        'price' => $variant['options_value_price']
                    ]);
                    $variant->attributes()->sync($attribute->id);
                }
            }
        }
    }
}
