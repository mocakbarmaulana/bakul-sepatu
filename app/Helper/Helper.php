<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class Helper {

    static function uploadImage($imgProduct, $imageDB, $folder){
        $imageName = $imageDB;
        if(!empty($imgProduct)){

            $imageName = md5(time() . '.' . $imgProduct->extension());

            Storage::putFileAs(
                'public/assets/images/'. $folder,
                $imgProduct,
                $imageName,
            );

            if ($imageDB != null) {
                Storage::delete("/public/assets/images/$folder/$imageDB");
            }
        }
        return $imageName;
    }

}

?>
