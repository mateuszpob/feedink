<?php

namespace Mp\Feedink\App;

class ImageProcessor
{
    private string $imagePath;

    public function __construct(private ImageDownloaderInterface $imageDownloader, private int $width, private int $heignt, private int $fontSize, private string $fileExtension)
    {
    }

    public function processImage(FeedRecord $record) : void
    {
        $image = $this->init($record);
        $header = $this->makeLabel($this->width, $this->fontSize, $record->title);
        $footer = $this->makeLabel($this->width, $this->fontSize, $record->price);

        $image = $this->resizeImage($image, $this->width, $this->heignt - $header->getImageHeight() - $footer->getImageHeight());

        $header->addImage($image);
        $header->addImage($footer);

        $header->resetIterator();
        $combined = $header->appendImages(true);

        $combined->setImageFormat('jpg');
        $combined->writeImage($this->imagePath);
    }

    public function init(FeedRecord $record) : \Imagick
    {
        $this->imagePath = $this->makeFilename($record);
        $this->imageDownloader->downloadImage($record->image_link, $this->imagePath);
        return new \Imagick($this->imagePath);
    }

    public function makeLabel(int $width, int $fontSize, string $label) : \Imagick
    {
        $wordwrap = $width / 2 / ($fontSize * 0.4);
        $label = wordwrap($label, $wordwrap);
        $lineCount = count(explode("\n", $label));
        $labelHeight = $fontSize * (($lineCount > 1 ? 2 : 1) + $lineCount);
        $offsetY = $fontSize + ($fontSize / 2);

        $draw = new \ImagickDraw();
        $pixel = new \ImagickPixel('gray');
        $draw->setFillColor('black');
        $draw->setFontSize($fontSize);
        $image = new \Imagick();
        $image->newImage($width, $labelHeight, $pixel);
        $image->annotateImage($draw, $fontSize, $offsetY, 0, $label);
        return $image;
    }

    public function resizeImage(\Imagick $image, int $width, int $height,) : \Imagick
    {
        $sourceRatio = $image->getImageWidth() / $image->getImageHeight();
        $targetRatio = $width / $height;

        if($sourceRatio > $targetRatio)
        {
            $image->scaleImage(0, $height);
            $startX = ($image->getImageWidth() - $width) / 2;
            $image->cropImage($width, $height, $startX, 0);
        } 
        else
        {
            $image->scaleImage($width, 0);
            $startY = ($image->getImageHeight() - $height) / 2;
            $image->cropImage($width, $height, 0, $startY);
        }
        return $image;
    }

    private function makeFilename(FeedRecord $record) : string
    {
        return $record->id . "." . $this->fileExtension;
    }
}
