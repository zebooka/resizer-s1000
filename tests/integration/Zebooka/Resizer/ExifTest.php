<?php

namespace Zebooka\Resizer;

use PHPUnit\Framework\TestCase;

class ExifTest extends TestCase
{
    private function resourceDirectory()
    {
        return __DIR__ . '/../../../res/exif';
    }

    public function test_not_existing_file()
    {
        $filename = $this->resourceDirectory() . '/not-existing.jpg';
        $this->expectExceptionObject(new \InvalidArgumentException('File \'' . $filename . '\' not found or is not readable.'));
        new Exif($filename);
    }

    public function test_failing_exiftool()
    {
        $filename = $this->resourceDirectory() . '/bad.jpg';
        $this->expectExceptionObject(new \RuntimeException('ExifTool failed with code #1.'));
        new Exif($filename);
    }

    public function test_exif_read()
    {
        $filename = $this->resourceDirectory() . '/cubie.jpg';
        $exif = new Exif($filename);
        $this->assertObjectHasAttribute('SourceFile', $exif);
        $this->assertObjectHasAttribute('FileName', $exif);
        $this->assertObjectHasAttribute('FileModifyDate', $exif);
        $this->assertObjectHasAttribute('MIMEType', $exif);
        $this->assertObjectHasAttribute('Make', $exif);
        $this->assertObjectHasAttribute('Model', $exif);
        $this->assertObjectHasAttribute('DateTimeOriginal', $exif);
        $this->assertObjectHasAttribute('Software', $exif);
        $this->assertEquals(date('Y-m-d H:i:s O', strtotime('2012-12-21 16:16:37')), $exif->DateTimeOriginal);
    }
}
