<?php

use Made\Cms\Tests\SubDomainTestCase;
use Made\Cms\Tests\TestCase;

uses(TestCase::class)
    ->in(__DIR__ . '/Default');

uses(SubDomainTestCase::class)
    ->in(__DIR__ . '/Subdomain');
