<?php

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    // tests
    public function testApp()
    {
        $this->assertNotEquals(null,Yii::$app);
    }

    public function testRequest()
    {
        $this->assertNotEquals(null,Yii::$app->request);
    }
}
