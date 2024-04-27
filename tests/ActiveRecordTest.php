<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once('/Users/danielstoyanov/Documents/php-demo/src/Entity.php');
require_once('/Users/danielstoyanov/Documents/php-demo/modules/page/models/Page.php');

class FakeStmt
{
    function execute()
    {
    }

    function fetchAll()
    {
        return [
            ['id' => 1, 'title' => 'fake title', 'content' => 'fake content'],
            ['id' => 2, 'title' => 'fake title2', 'content' => 'fake content']
        ];
    }
}

class FakeDatabaseConnection
{
    function prepare()
    {
        return new FakeStmt();
    }
}

final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $results = $page->findAll();

        $this->assertEquals(2, count($results));
        $this->assertEquals(2, $results[1]->id);
        $this->assertEquals('fake title2', $results[1]->title);
    }

    public function testFindBy(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $page->findBy('id', 2);

        $this->assertEquals(1, $page->id);
    }
}
