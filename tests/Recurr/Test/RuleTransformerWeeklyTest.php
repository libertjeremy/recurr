<?php

namespace Recurr\Test;

use Recurr\Rule;

class RuleTransformerWeeklyTest extends RuleTransformerBase
{
    public function testWeekly()
    {
        $timezone = 'America/New_York';
        $timezoneObj = new \DateTimeZone($timezone);

        $rule = new Rule(
            'FREQ=WEEKLY;COUNT=5;INTERVAL=1',
            new \DateTime('2013-06-13 00:00:00', $timezoneObj),
            $timezone
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2013-06-13 00:00:00', $timezoneObj), $computed[0]);
        $this->assertEquals(new \DateTime('2013-06-20 00:00:00', $timezoneObj), $computed[1]);
        $this->assertEquals(new \DateTime('2013-06-27 00:00:00', $timezoneObj), $computed[2]);
        $this->assertEquals(new \DateTime('2013-07-04 00:00:00', $timezoneObj), $computed[3]);
        $this->assertEquals(new \DateTime('2013-07-11 00:00:00', $timezoneObj), $computed[4]);
    }

    public function testWeeklyInterval()
    {
        $timezone = 'America/New_York';
        $timezoneObj = new \DateTimeZone($timezone);

        $rule = new Rule(
            'FREQ=WEEKLY;COUNT=5;INTERVAL=2',
            new \DateTime('2013-12-19 00:00:00', $timezoneObj),
            $timezone
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(5, count($computed));
        $this->assertEquals(new \DateTime('2013-12-19 00:00:00', $timezoneObj), $computed[0]);
        $this->assertEquals(new \DateTime('2014-01-02 00:00:00', $timezoneObj), $computed[1]);
        $this->assertEquals(new \DateTime('2014-01-16 00:00:00', $timezoneObj), $computed[2]);
        $this->assertEquals(new \DateTime('2014-01-30 00:00:00', $timezoneObj), $computed[3]);
        $this->assertEquals(new \DateTime('2014-02-13 00:00:00', $timezoneObj), $computed[4]);
    }

    public function testWeeklyIntervalLeapYear()
    {
        $timezone = 'America/New_York';
        $timezoneObj = new \DateTimeZone($timezone);

        $rule = new Rule(
            'FREQ=WEEKLY;COUNT=7;INTERVAL=2',
            new \DateTime('2015-12-21 00:00:00', $timezoneObj),
            $timezone
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(7, count($computed));
        $this->assertEquals(new \DateTime('2015-12-21 00:00:00', $timezoneObj), $computed[0]);
        $this->assertEquals(new \DateTime('2016-01-04 00:00:00', $timezoneObj), $computed[1]);
        $this->assertEquals(new \DateTime('2016-01-18 00:00:00', $timezoneObj), $computed[2]);
        $this->assertEquals(new \DateTime('2016-02-01 00:00:00', $timezoneObj), $computed[3]);
        $this->assertEquals(new \DateTime('2016-02-15 00:00:00', $timezoneObj), $computed[4]);
        $this->assertEquals(new \DateTime('2016-02-29 00:00:00', $timezoneObj), $computed[5]);
        $this->assertEquals(new \DateTime('2016-03-14 00:00:00', $timezoneObj), $computed[6]);
    }

    public function testWeeklyIntervalTouchingJan1()
    {
        $timezone = 'America/New_York';
        $timezoneObj = new \DateTimeZone($timezone);

        $rule = new Rule(
            'FREQ=WEEKLY;COUNT=3;INTERVAL=2',
            new \DateTime('2013-12-18 00:00:00', $timezoneObj),
            $timezone
        );

        $this->transformer->setRule($rule);
        $computed = $this->transformer->getComputedArray();

        $this->assertEquals(3, count($computed));
        $this->assertEquals(new \DateTime('2013-12-18 00:00:00', $timezoneObj), $computed[0]);
        $this->assertEquals(new \DateTime('2014-01-01 00:00:00', $timezoneObj), $computed[1]);
        $this->assertEquals(new \DateTime('2014-01-15 00:00:00', $timezoneObj), $computed[2]);
    }
}
