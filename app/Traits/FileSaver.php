<?php


namespace App\Traits;

trait FileSaver
{
    // <!-- upload file -->
    public function upload_file($file, $model, $fieldName, $basePath)
    {

        // <!-- upload file -->
        if ($file) {

            // <!-- delete file if exist -->
            if (file_exists($model->$fieldName)) {
                unlink($model->$fieldName);
            }

            // <!-- create unique file name -->
            $newFileName   = time() . '.' . $file->getClientOriginalExtension();
            $subdomain = "";

            // <!-- create upload directory -->
            $directory   = $subdomain . '_uploads/' . $basePath . '/' . date('Y') . '/';

            // <!-- create store file to directory -->
            $file->move($directory, $newFileName);

            // <!-- update file name to database -->
            $model->$fieldName = $directory . $newFileName;
            $model->save();
        }
    }
}
