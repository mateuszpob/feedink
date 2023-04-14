<?php

require __DIR__ . '/../vendor/autoload.php';

use Mp\Feedink\App\FeedProcessor;
use Mp\Feedink\App\ImageProcessor;
use Mp\Feedink\App\ImageDownloader;

$feedUrl = "https://feedink-public.s3.eu-central-1.amazonaws.com/static/dev_sample_feed.xml";
$imageWidth = 1000;
$imageHeight = 1000;
$fontSize = 30;
$fileExtension = 'jpg';

$feedLoader = new FeedProcessor($feedUrl, new ImageProcessor(new ImageDownloader(), $imageWidth, $imageHeight, $fontSize, $fileExtension));
$feedLoader->processFeed();

exit(0);
