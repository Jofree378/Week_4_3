<?php
namespace App\Controller;

use Intervention\Image\Response;
use Intervention\Image\ImageManagerStatic as Image;


class Loop
{
    protected static $path = '../public/images/';

    public function imageAction()
    {
        $source = self::$path . 'example.jpg';
        $result = self::$path . 'new_example.jpg';
        $image = Image::make($source)->resize(200, null, function ($image) {
                $image->aspectRatio();})
        ->save($result, 100);

        self::watermark($image);

        echo $image->response('png');
    }

    public static function watermark(\Intervention\Image\Image $image)
    {
        $image->text(
            'Example',
            '0',
            '0',
            function ($font){
                $font->size('25');
                $font->color(array(125, 12, 180));
                $font->align('left');
                $font->valign('top');
            }
        );
    }

}