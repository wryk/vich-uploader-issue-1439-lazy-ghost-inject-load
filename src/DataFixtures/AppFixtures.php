<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AppFixtures extends Fixture
{
    public function __construct(
        #[Autowire(param: 'kernel.project_dir')] private readonly string $projectDir,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $fs = new Filesystem();

        $picture = new Picture();
        $picturePath = $fs->tempnam(sys_get_temp_dir(), 'Cat');

        $fs->copy(
            Path::makeAbsolute('fixtures/inu.jpg', $this->projectDir),
            $picturePath,
            overwriteNewerFiles: true
        );

        $picture->setFile(new UploadedFile(
            path: $picturePath,
            originalName: 'cat.jpg',
            mimeType: 'image/jpeg',
            test: true,
        ));

        $cat = new Cat();
        $cat->setName('Inu');
        $cat->setBestPicture($picture);

        $manager->persist($cat);
        $manager->persist($picture);

        $manager->flush();
    }
}
