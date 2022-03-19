<?php

namespace App\Twig;

use App\Entity\Objects;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('className', [$this, 'getFunctions']),
            new TwigFilter('image', [$this, 'getImagesPath']),
            new TwigFilter('creation', [$this, 'getCreation']),
        ];
    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_class', 'get_class'),
        ];
    }
    public function getImagesPath($images): string
    {
        return 'upload/images/objects/'.$images;
    }

    public function getCreation($images): string
    {
        return 'img' . '/' . 'creations' . '/' . $images;
    }
}
