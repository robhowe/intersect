<?php
/**
 * Intersect/Point.php
 *
 * Defines a geometric point.
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


class Point extends GeometricElement
{
    // Just as an example of being overly-protected:
    protected $_x;
    protected $_y;


    //////////////////////////////


    public function __construct($x, $y = NULL)
    {
        if (is_array($x)) {
            $this->setX($x['x']);
            $this->setY($x['y']);
        } else {
            if (!is_int($x) || !is_int($y)) {
                throw new \InvalidArgumentException(__CLASS__ . ' requires x and y to be integers');
            }
            $this->setX($x);
            $this->setY($y);
        }
    }


    public function setX($value)
    {
        $this->_x = (int)$value;
        return $this;
    }

    public function getX()
    {
        return $this->_x;
    }


    public function setY($value)
    {
        $this->_y = (int)$value;
        return $this;
    }

    public function getY()
    {
        return $this->_y;
    }


    public function intersectPoint($point)
    {
        if (($this->x == $point->x) && ($this->y == $point->y)) {
            return true;
        }
        return false;
    }


    public function intersectLine($line)
    {

        // @TODO - need to fully implement this

        foreach($line->points as $p) {
            if ($this->intersect($p)) {
                return true;
            }
        }
        return false;
    }


    public function intersectCircle($circle)
    {

        // @TODO - need to fully implement this

        if ($this->intersect($circle->point)) {
            return true;
        }
        return false;
    }

}
