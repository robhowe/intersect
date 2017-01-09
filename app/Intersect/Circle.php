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
    protected $_point;  // One Point and a radius defines a circle
    protected $_radius;  // any valid number


    /**
     * A circle can be instantiated by providing a center Point and a radius.
     *
     * @param Point $p    The center Point.
     * @param number $radius    The radius of this circle.
     */
    public function __construct($p, $radius)
    {
        $this->point = $p;
        $this->radius = $radius;
    }


    /**
     * @param Point $value    The center Point of this circle.
     * @return $this
     */
    public function setPoint($value)
    {
        if (!($value instanceof Point)) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires a valid Point');
        }
        $this->_point = $value;
        return $this;
    }

    /**
     * @return Point    The center Point of this circle.
     */
    public function getPoint()
    {
        return $this->_point;
    }


    /**
     * @param number $value    The radius of this circle.
     * @return $this
     */
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

    /**
     * @return number    The radius of this circle.
     */
    public function getRadius()
    {
        return $this->_radius;
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Point $point    A Point to compare.
     * @return bool    True if the given Point intersects this Circle.
     */
    public function intersectPoint($point)
    {
        // No need to reimplement this logic again:
        return $point->intersect($this);
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Line $line    A Line to compare.
     * @return bool    True if the given Line intersects this Circle.
     */
    public function intersectLine($line)
    {
        // No need to reimplement this logic again:
        return $line->intersect($this);
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Circle $circle    Another Circle to compare.
     * @return bool    True if the given Circle intersects this one.
     */
    public function intersectCircle($circle)
    {

        // @TODO - need to fully implement this

        if ($this->point->intersect($circle->point)) {
            return true;
        }
        return false;
    }

}
