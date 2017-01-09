<?php

namespace Intersect\Tests\Line;

use PHPUnit\Framework\TestCase;
use Intersect\Point;
use Intersect\Line;
use Intersect\Circle;


class LineTest extends TestCase
{
    public function testInstantiate()
    {
        $line = new Line(new Point(0, 0), new Point(0, 1));
        $this->assertInstanceOf('Intersect\Line', $line);

        $this->assertTrue(
            method_exists($line, 'intersect'),
            'Class does not have required method'
        );
    }


    public function testInstantiateException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Line('bad arg');
    }


    public function testBadPropertyException()
    {
        $line = new Line(new Point(0, 0), new Point(0, 1));
        $this->expectException(\InvalidArgumentException::class);
        $line->badProp = 1;
    }


    public function testPoints()
    {
        // Verify no exceptions are thrown
        new Line(new Point(0, 0), new Point(1, 1));
        new Line(new Point(-1, -1), new Point(1, 1));
        new Line(new Point(-PHP_INT_MAX, PHP_INT_MAX), new Point(1, 1));
    }


    public function testPointsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Line(new Point(0, 0), new Point(0, 0));
    }


    public function testPoints2Exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Line(new Point(0, 0), 'bad point');
    }


    public function testPointIntersection()
    {
        $point = new Point(0, 0);
        $point2 = new Point(1, 1);
        $line = new Line($point, $point2);
        $point3 = new Point(0, 2);
        $this->assertTrue(
            $line->intersect($point),
            'Intersection calculation failure'
        );
        $this->assertTrue(
            $line->intersect($point2),
            'Intersection calculation2 failure'
        );

        $this->assertFalse(
            $point->intersect($point3),
            'Intersection calculation3 failure'
        );
    }


    /**
     * @dataProvider pointProvider
     */
    public function testPointIntersectionData($data)
    {
        $point = new Point(0, 0);
        $point2 = new Point(1, 1);
        $line = new Line($point, $point2);
        $testPoint = new Point($data);
        $this->assertTrue(
            $line->intersect($testPoint),
            'Intersection calculation failure'
        );
    }

    public function pointProvider()
    {

        // @TODO - need to fully implement this

        return [
            array(array('x' => 0, 'y' => 0)),
            array(array('x' => 1, 'y' => 1))
        ];
    }


    public function testLineIntersection()
    {
        $line = new Line(array(new Point(0, 0), new Point(1, 1)));
        $line2 = new Line(array(new Point(0, 0), new Point(0, -1)));
        $line3 = new Line(array(new Point(0, 1), new Point(1, 2)));

        $this->assertTrue(
            $line->intersect($line2),
            'Intersection calculation failure'
        );

        $this->assertFalse(
            $line->intersect($line3),
            'Intersection calculation2 failure'
        );
    }


    public function testCircleIntersection()
    {
        $point = new Point(0, 0);
        $point2 = new Point(1, 1);
        $line = new Line($point, $point2);

        $circle = new Circle($point, 1);
        $circle2 = new Circle($point2, 1);

        $circle3 = new Circle(new Point(0, 5), 1);

        $this->assertTrue(
            $line->intersect($circle),
            'Intersection calculation failure'
        );
        $this->assertTrue(
            $line->intersect($circle2),
            'Intersection calculation2 failure'
        );
        $this->assertFalse(
            $line->intersect($circle3),
            'Intersection calculation3 failure'
        );
    }

}
