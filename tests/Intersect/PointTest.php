<?php

namespace Intersect\Tests\Point;

use PHPUnit\Framework\TestCase;
use Intersect\Point;
use Intersect\Line;
use Intersect\Circle;


class PointTest extends TestCase
{
    public function testInstantiate()
    {
        $point = new Point(0, 0);
        $this->assertInstanceOf('Intersect\Point', $point);

        $this->assertTrue(
            method_exists($point, 'intersect'),
            'Class does not have required method'
        );
    }


    public function testInstantiateException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Point('bad arg');
    }


    public function testBadPropertyException()
    {
        $point = new Point(0, 0);
        $this->expectException(\InvalidArgumentException::class);
        $point->badProp = 1;
    }


    public function testCoords()
    {
        // Verify no exceptions are thrown
        new Point(0, 0);
        new Point(-1, 1);
        new Point(-PHP_INT_MAX, PHP_INT_MAX);
    }


    public function testCoordsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Point(-1.2, 1.2345);
    }


    public function testCoords2Exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Point(1, 'bad num');
    }


    public function testPointIntersection()
    {
        $point = new Point(0, 0);
        $point2 = new Point(0, 0);
        $point3 = new Point(0, 1);
        $this->assertTrue(
            $point->intersect($point2),
            'Intersection calculation failure'
        );

        $this->assertFalse(
            $point->intersect($point3),
            'Intersection calculation2 failure'
        );
    }


    /**
     * @dataProvider pointProvider
     */
    public function testPointIntersectionData($data)
    {
        $point = new Point($data);
        $this->assertTrue(
            $point->intersect($point),
            'Intersection calculation failure'
        );
        $uniquePoint = new Point(42,42);
        $this->assertFalse(
            $point->intersect($uniquePoint),
            'Intersection calculation2 failure'
        );
    }

    public function pointProvider()
    {
        return [
            array(array('x' => 0, 'y' => 0)),
            array(array('x' => 0, 'y' => 1)),
            array(array('x' => 1, 'y' => 0)),
            array(array('x' => 1, 'y' => 1)),
            array(array('x' => 0, 'y' => -1)),
            array(array('x' => -1, 'y' => 0)),
            array(array('x' => -1, 'y' => -1)),
            array(array('x' => 123, 'y' => 456)),
            array(array('x' => PHP_INT_MAX, 'y' => PHP_INT_MAX)),
            array(array('x' => -PHP_INT_MAX, 'y' => PHP_INT_MAX)),
            array(array('x' => PHP_INT_MAX, 'y' => -PHP_INT_MAX)),
            array(array('x' => -PHP_INT_MAX, 'y' => -PHP_INT_MAX))
        ];
    }


    public function testLineIntersection()
    {
        $point = new Point(0, 0);
        $line = new Line(array(new Point(0, 0), new Point(0, 1)));
        $line2 = new Line(array(new Point(1, 1), new Point(1, 2)));

        $this->assertTrue(
            $point->intersect($line),
            'Intersection calculation failure'
        );

        $this->assertFalse(
            $point->intersect($line2),
            'Intersection calculation2 failure'
        );
    }


    public function testCircleIntersection()
    {
        $point = new Point(0, 0);
        $circle = new Circle(new Point(0, 0), 1);
        $circle2 = new Circle(new Point(2, 2), 1);

        $this->assertTrue(
            $point->intersect($circle),
            'Intersection calculation failure'
        );

        $this->assertFalse(
            $point->intersect($circle2),
            'Intersection calculation2 failure'
        );
    }

}
