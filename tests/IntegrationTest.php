<?php

namespace App\Tests\Service;

use App\Entity\Cat;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\File;

class IntegrationTest extends KernelTestCase
{
    private function findCat(): Cat
    {
        $container = static::getContainer();

        $catRepository = $container->get(CatRepository::class);
        $cat = $catRepository->find(1);

        return $cat;
    }

    public function testVichUploader(): void
    {
        static::bootKernel();
        $cat = $this->findCat();

        // VichUploader is configured to hook on postLoad to inject the file object
        self::assertInstanceOf(File::class, $cat->getBestPicture()->getFile());
    }

    public function testDoctrineListener(): void
    {
        static::bootKernel();
        $cat = $this->findCat();

        // App\Event\PictureEntityListener hook on postLoad to set fake exif data
        self::assertArrayHasKey('X-IS-CAT-AWESOME', $cat->getBestPicture()->getExif());
    }
}
