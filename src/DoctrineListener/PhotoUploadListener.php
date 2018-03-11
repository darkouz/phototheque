<?php

namespace App\DoctrineListener;

use App\Entity\Photo;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class PhotoUploadListener
{

    private $uploader;

    public function __construct(FileUploader $uploader)
    {

        $this->uploader = $uploader;

    }
    public function prePersist(LifecycleEventArgs $args){

        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Photo) {
            return;
        }

        $file = $entity->getPath();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setPath($fileName);
        }
    }


}