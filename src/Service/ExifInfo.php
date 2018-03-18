<?php


namespace App\Service;


class ExifInfo
{

    private $thumbnailDirectory;

    /**
     * ExifInfo constructor.
     * @param $thumbnailDirectory
     */
    public function __construct($thumbnailDirectory)
    {
        $this->thumbnailDirectory = $thumbnailDirectory;
    }


    public function getThumbnail($filePath, $fileName)
    {

        $thumbNail = exif_thumbnail($filePath, $width, $height, $type);
        if ($thumbNail) {

            $im = imagecreatefromstring($thumbNail);
            $im = imagerotate($im, 0, 0);
            $thumbPath = "uploads/thumbnail/thumb_" . $fileName;
            imagejpeg($im, $this->thumbnailDirectory. "/thumb_" . $fileName);

            return $thumbPath;
        }
        return null;

    }

    public function getCreatedAt($filePath){

        $exif = exif_read_data($filePath, 'EXIF');
        $createdAt = $exif['DateTimeOriginal'];
        $createdAt = \DateTime::createFromFormat('Y:m:d H:i:s', $createdAt);

        return $createdAt;

    }

}