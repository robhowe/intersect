<?php
/**
 * Intersect/Line.php
 *
 * Defines a geometric line.
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


class Line extends GeometricElement
{
    // Just as an example of being overly-protected:
    protected $_point = array();  // two points define a line
        // although in theory someday a line could have multiple points


    /**
     * A line can be instantiated from either:
     *   an array of two points,
     *   or two separate Point args.
     *
     * @param $p1    An array of two points, or a Point.
     * @param $p2    (optional) A second Point.
     */
    public function __construct($p1, $p2 = NULL)
    {
        if (is_array($p1) && 
            (count($p1) == 2) && 
            ($p1[0] instanceof Point) &&
            ($p1[1] instanceof Point)) {
            $this->setPoint(0, $p1[0]);
            $this->setPoint(1, $p1[1]);
        } else {
            $this->setPoint(0, $p1);
            $this->setPoint(1, $p2);
        }

        // Verify the two Points are not the same
        if ($this->getPoint(0)->intersect($this->getPoint(1))) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires two DIFFERENT Point args');
        }
    }


    /**
     * Set a single defined Point (via index) in this line.
     *
     * @param int $index    The array index of this Point (0 or 1).
     * @param Point $value    A Point on this line.
     * @return $this
     */
    public function setPoint($index, $value)
    {
        if (!($value instanceof Point)) {
            throw new \InvalidArgumentException('Not a valid Point obj');
        }
        $this->_point[$index] = $value;
        return $this;
    }

    /**
     * @return Point    A single defined point (via index) in this line.
     */
    public function getPoint($index)
    {
        return $this->_point[$index];
    }

    /**
     * @return array    An array of all (two) defined points in this line.
     */
    public function getPoints()
    {
        return $this->_point;
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Point $point    A Point to compare.
     * @return bool    True if the given Point intersects this Line.
     */
    public function intersectPoint($point)
    {
        // No need to reimplement this logic again:
        return $point->intersect($this);
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Line $line    Another Line to compare.
     * @return bool    True if the given Line intersects this one.
     */
    public function intersectLine($line)
    {

        // @TODO - need to fully implement this

        foreach($this->points as $p) {
            if ($line->intersect($p)) {
                return true;
            }
        }
        return false;
    }


    /**
     * @see GeometricElement::intersect()    To see how this method is invoked.
     * @param Circle $circle    A Circle to compare.
     * @return bool    True if the given Circle intersects this Line.
     */
    public function intersectCircle($circle)
    {

        // @TODO - need to fully implement this

        foreach($this->points as $p) {
            if ($p->intersect($circle->point)) {
                return true;
            }
        }
        return false;
    }

}
