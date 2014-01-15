<?php

namespace Recurr\Test;

use Recurr\Rule;

class RuleTransformerByWeekNumberTest extends RuleTransformerBase
{
    public function testByWeekNumber()
    {
        $rule = new Rule(
            'FREQ=YEARLY;COUNT=5;BYWEEKNO=22;WKST=SU',
            new \DateTime('2013-05-30')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2013-05-30'), $computed[0]);
        $this->assertEquals(new \DateTime('2013-05-31'), $computed[1]);
        $this->assertEquals(new \DateTime('2013-06-01'), $computed[2]);
        $this->assertEquals(new \DateTime('2014-05-25'), $computed[3]);
        $this->assertEquals(new \DateTime('2014-05-26'), $computed[4]);
    }

    public function testByWeekNumberNegative()
    {
        $rule = new Rule(
            'FREQ=YEARLY;COUNT=5;BYWEEKNO=-44;WKST=TH',
            new \DateTime('2013-05-30')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2014-02-27'), $computed[0]);
        $this->assertEquals(new \DateTime('2014-02-28'), $computed[1]);
        $this->assertEquals(new \DateTime('2014-03-01'), $computed[2]);
        $this->assertEquals(new \DateTime('2014-03-02'), $computed[3]);
        $this->assertEquals(new \DateTime('2014-03-03'), $computed[4]);
    }

    public function testByWeekNumberWeek53()
    {
        $rule = new Rule(
            'FREQ=YEARLY;COUNT=5;BYWEEKNO=53;WKST=MO',
            new \DateTime('2013-05-30')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2015-12-28'), $computed[0]);
        $this->assertEquals(new \DateTime('2015-12-29'), $computed[1]);
        $this->assertEquals(new \DateTime('2015-12-30'), $computed[2]);
        $this->assertEquals(new \DateTime('2015-12-31'), $computed[3]);
        $this->assertEquals(new \DateTime('2016-01-01'), $computed[4]);
    }

    public function testByWeekNumberWeek53Negative()
    {
        $rule = new Rule(
            'FREQ=YEARLY;COUNT=5;BYWEEKNO=-53;WKST=MO',
            new \DateTime('2008-05-30')
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2009-01-01'), $computed[0]);
        $this->assertEquals(new \DateTime('2009-01-02'), $computed[1]);
        $this->assertEquals(new \DateTime('2009-01-03'), $computed[2]);
        $this->assertEquals(new \DateTime('2009-01-04'), $computed[3]);
        $this->assertEquals(new \DateTime('2015-01-01'), $computed[4]);
    }
}
