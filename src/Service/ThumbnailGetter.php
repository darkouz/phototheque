<?php

namespace App\Service;


class ThumbnailGetter
{
    private $targetDirectory;

    /**
     * ThumbnailGetter constructor.
     * @param $targetDirectory
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function getThumbnail($filePath,$fileName)
    {

        $thumbNail = exif_thumbnail($filePath,$width,$height,$type);
        if ($thumbNail){

            $im =imagecreatefromstring($thumbNail);
            $im = imagerotate($im,0,0);
            $thumbPath = "uploads/thumbnail/thumb_".$fileName;
            imagejpeg($im,$this->targetDirectory."/thumb_".$fileName);

            return $thumbPath;

        }



    }

    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }


}