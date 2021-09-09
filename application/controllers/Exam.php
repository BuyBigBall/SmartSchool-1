<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once("Homework.php");
class Exam extends Homework
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        parent::index();
    }
}
