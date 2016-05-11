<?php


require_once 'include/upload_file.php';
//require_once 'include/utils/php_zip_utils.php';
class php_zip_utilsTest extends PHPUnit_Framework_TestCase
{
    /** @var array  */
    protected $filesToZip = ['index.php', 'config.php'];

    public function testunzip()
    {
        //execute the method and test if it returns true and verify the if unzipped files exist

        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $zipFile = $cache_dir.'/zipTest.zip';

        //create a zip file first, to unzip
        if (file_exists($zipFile)) {
            unlink($zipFile);
        }
        zip_files_list($zipFile, $this->filesToZip);

        $result = unzip($zipFile, $cache_dir);
        $this->assertTrue($result);

        foreach($this->filesToZip as $unzipped) {
            $this->assertFileExists($cache_dir.'/'.$unzipped);
            unlink($cache_dir.'/'.$unzipped);
        }
        unlink($zipFile);
    }

    public function testunzip_file()
    {

        //execute the method and test if it returns true and verify the if unzipped files exist

        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $zipFile = $cache_dir.'/zipTest.zip';

        //creata a zip file first, to unzip
        if (file_exists($zipFile)) {
            unlink($zipFile);
        }
        zip_files_list($zipFile, $this->filesToZip);

        $result = unzip_file($zipFile, null, $cache_dir);
        $this->assertTrue($result);

        foreach($this->filesToZip as $unzipped) {
            $this->assertFileExists($cache_dir.'/'.$unzipped);
            unlink($cache_dir.'/'.$unzipped);
        }
        unlink($zipFile);
    }

    public function testzip_dir()
    {
        //execute the method and verify the if zipped file exist
        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $zipFile = $cache_dir.'/zipTest.zip';

        if (file_exists($zipFile)) {
            unlink($zipFile);
        }

        zip_dir($cache_dir.'/modules', $zipFile);
        $this->assertFileExists($zipFile);
        unlink($zipFile);
    }

    public function testzip_files_list()
    {

        //execute the method and verify the if zipped file exist
        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $zipFile = $cache_dir.'/ziplistTest.zip';

        if (file_exists($zipFile)) {
            unlink($zipFile);
        }

        $result = zip_files_list($zipFile, $this->filesToZip);
        $this->assertTrue($result);
        $this->assertFileExists($zipFile);
        unlink($zipFile);
    }
}
