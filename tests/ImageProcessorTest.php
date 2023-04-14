<?php declare(strict_types=1);

use Mp\Feedink\App\ImageProcessor;
use Mp\Feedink\App\FeedRecord;
use Mp\Feedink\App\ImageDownloaderMock;
use PHPUnit\Framework\TestCase;

final class ImageProcessorTest extends TestCase
{
    private ImageProcessor $imageProcessor;
    private FeedRecord $testFeedRecord;

    public function setUp() : void
    {
        $imageWidth = 1000;
        $imageHeight = 1000;
        $fontSize = 30;
        $fileExtension = 'jpg';

        $this->testFeedRecord = new FeedRecord(file_get_contents(__DIR__ . "/dev_sample_feed.xml"));
        $this->testFeedRecord->price = "1111";
        $this->testFeedRecord->title = "1111 1111 1111 1111 1111 1111";
        $this->testFeedRecord->image_link = "1111";
        $this->testFeedRecord->id = "tests/test_image";

        $this->imageProcessor = new ImageProcessor(new ImageDownloaderMock(), $imageWidth, $imageHeight, $fontSize, $fileExtension);
    }

    public function test_init_image() : void
    {
        $image = $this->imageProcessor->init($this->testFeedRecord);
        $this->assertInstanceOf(\Imagick::class, $image);
    }

    public function test_make_label() : void
    {
        $image = $this->imageProcessor->makeLabel(100, 10, "tets");
        $this->assertInstanceOf(\Imagick::class, $image);
    }

    public function test_resize_image() : void
    {
        $image = new \Imagick();
        $image->newImage(1200, 800, "red");

        $image = $this->imageProcessor->resizeImage($image, 800, 400);

        $this->assertEquals(800, $image->getImageWidth());
        $this->assertEquals(400, $image->getImageHeight());
    }
}