<?php

namespace Mp\Feedink\App;

class FeedRecord extends \SimpleXMLElement
{
    public string $id;
    public float $price;
    public string $currency;
    public string $brand;
    public string $title;
    public string $url;
    public string $image_link;
}