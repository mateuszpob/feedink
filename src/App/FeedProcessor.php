<?php

namespace Mp\Feedink\App;

class FeedProcessor
{
    public function __construct(public string $feddPath, public ImageProcessor $imageProcessor)
    {}

    public function processFeed() : void
    {
        $xml = new \XMLReader();
        $xml->open($this->feddPath);
        
        while($xml->read() && $xml->name != 'record');

        while($xml->name == 'record')
        {
            $record = new FeedRecord($xml->readOuterXML());
            $this->imageProcessor->processImage($record);

            $xml->next('record');
	        unset($record);
        }

        $xml->close();
    }
}