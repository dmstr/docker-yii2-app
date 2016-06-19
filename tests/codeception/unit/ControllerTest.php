<?php

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testApp()
    {
        $this->assertNotEquals(null,Yii::$app);
    }
}
