<?php

namespace Invertus\Tests\Integration\Http;

use Invertus\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

class HttpUploadedFileTest extends TestCase
{
    public function testUploadedFileCanRetrieveContentsFromTextFile()
    {
        $file = new UploadedFile(
            __DIR__.'/fixtures/test.txt',
            'test.txt',
            null,
            null,
            false,
            true
        );

        $this->assertSame('This is a story about something that happened long ago when your grandfather was a child.', trim($file->get()));
    }
}
