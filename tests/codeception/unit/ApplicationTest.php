<?php

class ApplicationTest extends \PHPUnit_Framework_TestCase
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

    public function testUser()
    {
        $this->assertNotEquals(null,Yii::$app->request);
    }
}
