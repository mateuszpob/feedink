<?php

namespace Mp\Feedink\App;

interface ImageDownloaderInterface
{
    public function downloadImage(string $url, string $filename) : void;
}