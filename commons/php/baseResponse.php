<?php
class RequestResponse
{
  public $success;
  public $message;
  public $path;

  function __construct()
  {
  }

  public static function newPage($success, $path)
  {
    $instance = new self();
    $instance->success = $success;
    $instance->path = $path;
    return $instance;
  }

  public static function basicResponse($success, $message)
  {
    $instance = new self();
    $instance->success = $success;
    $instance->message = $message;
    return $instance;
  }
}
