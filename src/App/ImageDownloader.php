<?php

namespace Mp\Feedink\App;

class ImageDownloader implements ImageDownloaderInterface
{
    public function downloadImage(string $url, string $filename) : void
    {
        if(file_exists($filename)){
            unlink($filename);
        }
        $fp = fopen($filename, 'x');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_exec ($ch);
        curl_close ($ch);
        fclose($fp);
    }
}