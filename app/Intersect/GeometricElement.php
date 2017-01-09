<?php
/**
 * Intersect/GeometricElement.php
 *
 * This is the base class of the Intersect coding exercise.
 * All geometric elements extend from this class.
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


class GeometricElement
{
    public function __set($name, $value)
    {
        $method = "set$name";

        if (($name == 'mapper') || !method_exists($this, $method)) {
            throw new \InvalidArgumentException("Invalid mapper method \"{$method}\"");
        }

        $this->$method($value);
    }

    public function __get($name)
    {
        $method = "get$name";

        if (($name == 'mapper') || !method_exists($this, $method)) {
            throw new \InvalidArgumentException("Invalid mapper method \"{$method}\"");
        }

        return $this->$method();
    }


    /**
     * This "wrapper" method shouldn't need to be overridden by any sub-classes,
     * instead, sub-classes will implement functions such as:
     *   intersectPoint(), intersectLine(), intersectCircle(), etc.
     */
    final public function intersect($element = NULL)
    {
        if (!is_object($element)) {
            throw new \InvalidArgumentException('Object argument required');
        }

        // Any element always easily intersects with itself
        if ($this === $element) {
            return true;
        }

        $className = str_replace('Intersect\\', '', get_class($element));
        $method = "intersect$className";
        if (!method_exists($this, $method)) {
            throw new \InvalidArgumentException('Intersection of ' . __CLASS__ .
                                                " with $className not supported");
        }

        return $this->$method($element);
    }

}
