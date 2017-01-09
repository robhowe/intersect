# Intersect

A library project created by Rob Howe <rob@robhowe.com> in response to a Coding Assessment.

## Requirements:

Given three geometric elements: circle, lines, and points. Detect the intersection of 

* A point inside a circle
* A circle intersecting with another circle
* A line intersecting with another line
* A line intersecting a point 

A point is defined by an x,y coordinate.  i.e.: [0,0] would be at the origin.
~~~~
$point = new Point(0, 0);
~~~~

A circle is defined by a point and a radius.
~~~~
point = [6, 3]
radius = 5
$circle = new Circle(point, radius)
~~~~

A line can be defined by two points
~~~~
p1 = [0, 0]
p2 = [4, 2]
$line = new Line(p1, p2)
~~~~

~~~~
def intersect(a, b)
  # Should return true or false indicating whether or not
  # a and b intersect.
end
~~~~
You may also find it more natural to define a.intersect(b).

The only hard requirement is that the `intersect` method(s) return the correct truth values.

Along with solutions - the code follows PSR defined by PHP-FIG and includes PHPUnit tests.


*****

Note - This is a programming exercise, not an enterprise-level production-ready library.

*****

## Installation:

This is a simple library project utilizing composer.
To get started, run the following commands from the library's base dir:
~~~~
composer update
phpunit
~~~~

## License

See the included LICENSE.txt file.
All information contained within this project is, and remains the property of Rob Howe.
