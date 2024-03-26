<?php

namespace App\Event;

use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostLoadEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::postLoad, method: 'postLoad', entity: Picture::class)]
class PictureEntityListener
{
    public function postLoad(Picture $picture, PostLoadEventArgs $event): void
    {
        $picture->setExif([
            'X-IS-CAT-AWESOME' => 'ALWAYS'
        ]);
    }
}
