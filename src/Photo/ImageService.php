<?php
namespace Acme\Photo;

use Acme\Core\AbstractImageService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService extends AbstractImageService {

    public function store(UploadedFile $image)
    {
        return $this->process($image,['large','medium','thumbnail']);
    }

} 