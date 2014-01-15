<?php

namespace Recurr\Test;

use Recurr\Rule;

class RuleTransformerBySetPositionTest extends RuleTransformerBase
{
    public function testBySetPosition()
    {
        $rule = new Rule(
            'FREQ=MONTHLY;BYSETPOS=-1;BYDAY=MO,TU,WE,TH,FR;COUNT=5',
            new \DateTime('2013-01-24')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2013-01-31'), $computed[0]);
        $this->assertEquals(new \DateTime('2013-02-28'), $computed[1]);
        $this->assertEquals(new \DateTime('2013-03-29'), $computed[2]);
        $this->assertEquals(new \DateTime('2013-04-30'), $computed[3]);
        $this->assertEquals(new \DateTime('2013-05-31'), $computed[4]);

        // --------------------------------------

        $rule = new Rule(
            'FREQ=MONTHLY;BYSETPOS=-1;BYDAY=MO,TU,WE,TH,FR;COUNT=5',
            new \DateTime('2016-01-24')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2016-01-29'), $computed[0]);
        $this->assertEquals(new \DateTime('2016-02-29'), $computed[1]);
        $this->assertEquals(new \DateTime('2016-03-31'), $computed[2]);
        $this->assertEquals(new \DateTime('2016-04-29'), $computed[3]);
        $this->assertEquals(new \DateTime('2016-05-31'), $computed[4]);

        // --------------------------------------

        $rule = new Rule(
            'FREQ=MONTHLY;BYSETPOS=1,-1;BYDAY=MO,TU,WE,TH,FR;COUNT=5',
            new \DateTime('2016-01-24')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2016-01-29'), $computed[0]);
        $this->assertEquals(new \DateTime('2016-02-01'), $computed[1]);
        $this->assertEquals(new \DateTime('2016-02-29'), $computed[2]);
        $this->assertEquals(new \DateTime('2016-03-01'), $computed[3]);
        $this->assertEquals(new \DateTime('2016-03-31'), $computed[4]);
    }

    public function testBySetPositionWithInterval()
    {
        $rule = new Rule(
            'FREQ=MONTHLY;INTERVAL=2;BYDAY=MO;BYSETPOS=2;COUNT=10',
            new \DateTime('2013-10-09')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(10, count($computed));
        $this->assertEquals(new \DateTime('2013-10-14'), $computed[0]);
        $this->assertEquals(new \DateTime('2013-12-09'), $computed[1]);
        $this->assertEquals(new \DateTime('2014-02-10'), $computed[2]);
        $this->assertEquals(new \DateTime('2014-04-14'), $computed[3]);
        $this->assertEquals(new \DateTime('2014-06-09'), $computed[4]);
        $this->assertEquals(new \DateTime('2014-08-11'), $computed[5]);
        $this->assertEquals(new \DateTime('2014-10-13'), $computed[6]);
        $this->assertEquals(new \DateTime('2014-12-08'), $computed[7]);
        $this->assertEquals(new \DateTime('2015-02-09'), $computed[8]);
        $this->assertEquals(new \DateTime('2015-04-13'), $computed[9]);
    }
}
