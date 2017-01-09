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
    protected $_point = array();  // two Points define a line
        // although in theory someday a line could have multiple points


    //////////////////////////////


    public function __construct($p1, $p2 = NULL)
    {
        if (is_array($p1) && 
            (count($p1) == 2) && 
            ($p1[0] instanceof Point) &&
            ($p1[1] instanceof Point)) {
            $this->_point[0] = $p1[0];
            $this->_point[1] = $p1[1];
        } else {
            if (!($p1 instanceof Point) ||
                !($p2 instanceof Point)) {
                throw new \InvalidArgumentException(__CLASS__ . ' requires two valid Point args');
            }
            $this->_point[0] = $p1;
            $this->_point[1] = $p2;
        }

        // Verify the two Points are not the same
        if ($this->_point[0]->intersect($this->_point[1])) {
            throw new \InvalidArgumentException(__CLASS__ . ' requires two DIFFERENT Point args');
        }
    }


    public function setPoint($index, $value)
    {
        $this->_point[$index] = new Point($value);
        return $this;
    }

    /**
     * Return a single defined point (via index) in line.
     */
    public function getPoint($index)
    {
        return $this->_point[$index];
    }

    /**
     * Return array of all defined points in line.
     */
    public function getPoints()
    {
        return $this->_point;
    }


    public function intersectPoint($point)
    {

        foreach($this->points as $p) {
            if ($point->intersect($p)) {
                return true;
            }
        }
        return false;
    }


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
