<?php
/**
 * Created by PhpStorm.
 * User: Pavel Tsvetkov
 * Date: 08.08.2018
 * Time: 18:25
 */

namespace app\responses;

/**
 * Class BaseResponse
 * @package app\responses
 */
class BaseResponse extends \yii\web\Response
{
    /** @var */
    public $body;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return bool
     */
    public function setBody($body)
    {
        $this->body = $body;

        return true;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode([
            'status' => $this->getStatusCode(),
            'message' => $this->statusText,
            'body' => $this->getBody()
        ]);
    }
}
