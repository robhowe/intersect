<?php

namespace Intersect\Tests\Circle;

use PHPUnit\Framework\TestCase;
use Intersect\Point;
use Intersect\Line;
use Intersect\Circle;


class CircleTest extends TestCase
{
    public function testInstantiate()
    {
        $circle = new Circle(new Point(0, 0), 1);
        $this->assertInstanceOf('Intersect\Circle', $circle);

        $this->assertTrue(
            method_exists($circle, 'intersect'),
            'Class does not have required method'
        );
    }


    public function testInstantiateException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Circle(new Point(0, 0), 'bad arg');
    }


    public function testBadPropertyException()
    {
        $circle = new Circle(new Point(0, 0), 1);
        $this->expectException(\InvalidArgumentException::class);
        $circle->badProp = 1;
    }


    public function testPoints()
    {
        // Verify no exceptions are thrown
        new Circle(new Point(0, 0), 1);
        new Circle(new Point(-1, -1), -1);
        new Circle(new Point(-PHP_INT_MAX, PHP_INT_MAX), PHP_INT_MAX);
    }


    public function testRadiusException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Circle(new Point(0, 0), 0);
    }


    public function testPointIntersection()
    {
        $point = new Point(0, 0);
        $point2 = new Point(2, 2);
        $circle = new Circle($point, 1);
        $this->assertTrue(
            $circle->intersect($point),
            'Intersection calculation failure'
        );
        $this->assertFalse(
            $circle->intersect($point2),
            'Intersection calculation2 failure'
        );
    }


    /**
     * @dataProvider pointProvider
     */
    public function testPointIntersectionData($data)
    {
        $point = new Point(0, 0);
        $circle = new Circle($point, 3);
        $testPoint = new Point($data);
        $this->assertTrue(
            $circle->intersect($testPoint),
            'Intersection calculation failure'
        );
    }

    public function pointProvider()
    {

        // @TODO - need to fully implement this

        return [
            array(array('x' => 0, 'y' => 0))
        ];
    }


    public function testLineIntersection()
    {
        $point = new Point(0, 0);
        $point2 = new Point(1, 1);
        $line = new Line($point, $point2);
        $point3 = new Point(5, 1);
        $point4 = new Point(6, 2);
        $line2 = new Line($point3, $point4);
        $circle = new Circle($point, 3);

        $this->assertTrue(
            $circle->intersect($line),
            'Intersection calculation failure'
        );

        $this->assertFalse(
            $circle->intersect($line2),
            'Intersection calculation2 failure'
        );
    }


    public function testCircleIntersection()
    {
        $point = new Point(0, 0);
        $circle = new Circle($point, 1);
        $circle2 = new Circle($point, 1);
        $point2 = new Point(2, 2);
        $circle3 = new Circle($point2, 1);

        $this->assertTrue(
            $circle->intersect($circle2),
            'Intersection calculation failure'
        );
        $this->assertFalse(
            $circle->intersect($circle3),
            'Intersection calculation2 failure'
        );
    }

}
