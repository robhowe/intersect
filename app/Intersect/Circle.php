<?php
/**
 * Intersect/Circle.php
 *
 * Defines a geometric circle.
 *
 * PHP version 5.6
 *
 * @category   Intersect
 * @package    Intersect
 * @author     Rob Howe <rob@robhowe.com>
 * @copyright  2017 Rob Howe
 * @license    This file is proprietary and subject to the terms defined in file LICENSE.txt
 * @version    Bitbucket via git: $Id$
 * @link       http://www.robhowe.com
 * @since      version 1.0
 */

namespace Intersect;


class Circle extends GeometricElement
{
    // Just as an example of being overly-protected:
    // One Point and a Radius defines a circle
    protected $_point;
    protected $_radius;  // any valid number


    //////////////////////////////


    public function __construct($p, $radius)
    {
        $this->point = $p;
        $this->radius = $radius;
    }


    public function setPoint($value)
    {
        if (!($value instanceof Point)) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires a valid Point');
        }
        $this->_point = $value;
        return $this;
    }

    public function getPoint()
    {
        return $this->_point;
    }


    public function setRadius($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires a valid numeric radius');
        }
        if ($value == 0) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires a non-zero radius');
        }
        $this->_radius = abs($value);
        return $this;
    }

    public function getRadius()
    {
        return $this->_radius;
    }


    public function intersectPoint($point)
    {

        // @TODO - need to fully implement this

        if ($this->point->intersect($point)) {
            return true;
        }
        return false;
    }


    public function intersectLine($line)
    {

        // @TODO - need to fully implement this

        if ($this->point->intersect($line)) {
            return true;
        }
        return false;
    }


    public function intersectCircle($circle)
    {

        // @TODO - need to fully implement this

        if ($this->point->intersect($circle->point)) {
            return true;
        }
        return false;
    }

}
