<?php

class RequestResponse
{
  public $success;
  public $message;
  public $path;
  public $filename;

  function __construct()
  {
  }

  public static function newPage($success, $path, $filename)
  {
    $instance = new self();
    $instance->success = $success;
    $instance->path = $path;
    $instance->filename = $filename;
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
