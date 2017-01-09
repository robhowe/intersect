<?php

namespace Intersect\Tests\GeometricElement;

use PHPUnit\Framework\TestCase;
use Intersect\GeometricElement;


class GeometricElementTest extends TestCase
{
    public function testInstantiate()
    {
        $element = new GeometricElement();
        $this->assertInstanceOf('Intersect\GeometricElement', $element);

        $this->assertTrue(
            method_exists($element, 'intersect'),
            'Class does not have required method'
        );

        $this->assertTrue(
            $element->intersect($element),
            'Self-intersection calculation failure'
        );
    }


    public function testInstantiateException()
    {
        $element = new GeometricElement();
        $this->expectException(\InvalidArgumentException::class);
        $element->badProp = 1;
    }


    public function testInvalidIntersectException()
    {
        $element = new GeometricElement();
        $this->expectException(\InvalidArgumentException::class);
        $element->intersect();
    }


    public function testInvalidIntersect2Exception()
    {
        $element = new GeometricElement();
        $this->expectException(\InvalidArgumentException::class);
        $element->intersect('bad arg');
    }


    public function testNotImplementedException()
    {
        $element = new GeometricElement();
        $element2 = new GeometricElement();
        $this->expectException(\InvalidArgumentException::class);
        $element->intersect($element2);
    }

}
