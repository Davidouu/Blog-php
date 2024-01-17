<?php

namespace App\Config;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\DAL;

class SetupDataBase
{
    /**
     * Setup database
     * @return void
     */
    public static function setup(): void
    {
        // Load environment variables
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../', '.env.local');
        $dotenv->load();

        // Create query to create database
        $db = new DAL();
        $query = file_get_contents(__DIR__ . '/blog-php.sql');

        // Execute query
        $db->execute($query);
    }
}

SetupDataBase::setup();
