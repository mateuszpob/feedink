<?php

namespace Mp\Feedink\App;

class ImageDownloaderMock implements ImageDownloaderInterface
{
    public function downloadImage(string $url, string $filename) : void
    {
    }
}