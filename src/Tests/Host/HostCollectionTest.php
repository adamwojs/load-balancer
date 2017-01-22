<?php

namespace AdamWojs\LoadBalancer\Tests\Host;

use AdamWojs\LoadBalancer\Host\HostCollection;
use PHPUnit\Framework\TestCase;

class HostCollectionTest extends TestCase
{
    public function testCountOfEmptyCollection()
    {
        $collection = new HostCollection();
        $this->assertEquals(0, $collection->count());
    }

    public function testCountOfNonEmptyCollection()
    {
        $collection = new HostCollection([
            new Host("A", 0)
        ]);

        $this->assertEquals(1, $collection->count());
    }

    public function testIsEmpty()
    {
        $collection = new HostCollection();

        $this->assertTrue($collection->isEmpty());
    }

    public function testContains()
    {
        $a = new Host("A");
        $b = new Host("B");
        $c = new Host("C");

        $collection = new HostCollection([$a, $b]);

        $this->assertTrue($collection->contains($a));
        $this->assertTrue($collection->contains($b));
        $this->assertNotTrue($collection->contains($c));
    }

    public function testAddElement()
    {
        $a = new Host("A", 0);
        $b = new Host("B", 0);

        $collection = new HostCollection();
        $collection->add($a);
        $collection->add($b);

        $this->assertEquals(2, $collection->count());
        $this->assertContains($a, $collection->getIterator());
        $this->assertContains($b, $collection->getIterator());
    }

    public function testRemoveElement()
    {
        $a = new Host("A", 0);

        $collection = new HostCollection([$a]);
        $collection->remove($a);

        $this->assertEquals(0, $collection->count());
    }
}
