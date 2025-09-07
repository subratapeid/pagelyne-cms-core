<?php
namespace App\Core;
// version updated 9
class CoreService
{
    public static function getVersion()
    {
        $versionFile = __DIR__ . '/version.txt';
        return file_exists($versionFile) ? file_get_contents($versionFile) : 'v0.0.1';
    }

    public static function updateCore($sourcePath)
    {
        $corePath = __DIR__;
        // Copy all files from sourcePath to Core folder
        $files = scandir($sourcePath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $src = $sourcePath . '/' . $file;
            $dst = $corePath . '/' . $file;

            if (is_dir($src)) {
                self::copyDir($src, $dst);
            } else {
                copy($src, $dst); // overwrite existing core files
            }
        }
        echo "Core updated successfully!\n";
    }

    private static function copyDir($src, $dst)
    {
        if (!is_dir($dst)) mkdir($dst, 0755, true);
        $files = scandir($src);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;
            if (is_dir($srcPath)) {
                self::copyDir($srcPath, $dstPath);
            } else {
                copy($srcPath, $dstPath);
            }
        }
    }
}
