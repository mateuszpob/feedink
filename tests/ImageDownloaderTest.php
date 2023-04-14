<?php declare(strict_types=1);

use Mp\Feedink\App\ImageDownloader;
use PHPUnit\Framework\TestCase;

final class ImageDownloaderTest extends TestCase
{
    private ImageDownloader $imageDownloader;

    public function setUp() : void
    {
        $this->imageDownloader = new ImageDownloader();
    }

    public function test_image_downloader() : void
    {
        $outputFile = __DIR__ . '/test_image_out.jpg';
        unlink($outputFile);
        $this->imageDownloader->downloadImage('https://freetestdata.com/wp-content/uploads/2022/02/Free_Test_Data_1MB_JPG.jpg', $outputFile);
        $this->assertFileExists($outputFile);
        unlink($outputFile);
    }
}