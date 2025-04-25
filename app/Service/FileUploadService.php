<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Handles image upload for Product CRUD operations with Barcode & Qrcode.
     * This method is specifically designed for product-related images.
     * If the model already has an image, it deletes the old file before uploading a new one.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the file.
     * @param \Illuminate\Database\Eloquent\Model $model The model to associate the uploaded file with.
     * @param string $path The storage path for uploaded images. Default is 'public/uploads'.
     * @return string|null The public URL of the uploaded image, or null if no file is uploaded.
     */
    public function imageUpload($request, $model, $path = 'public/uploads')
    {
        if ($request->hasFile('file')) {
            $uploaded_file = $request->file('file');
            // If Old File Exists, delete it
            if ($model->file) {
                Storage::delete($model->file);
            }

            $file_extension = $uploaded_file->getClientOriginalExtension();
            // Dynamically name the file with the model ID and extension
            $file_name = $model->id . '.jpg';
            $file_upload_url = Storage::putFileAs($path, $uploaded_file, $file_name, 'public');

            return Storage::url($file_upload_url);
        }
        return null;
    }

    /**
     * Handles general file upload for any CRUD operation.
     * This method can be used for any type of file upload and is not restricted to specific models.
     * If the model already has a file, it deletes the old file before uploading a new one.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the file.
     * @param \Illuminate\Database\Eloquent\Model $model The model to associate the uploaded file with.
     * @param string $path The storage path for uploaded files. Default is 'public/uploads'.
     * @return string|null The public URL of the uploaded file, or null if no file is uploaded.
     */
    public function fileUpload($request, $model, $path = 'public/uploads')
    {
        if ($request->hasFile('file')) {
            $uploaded_file = $request->file('file');
            // If Old File Exists, delete it
            if ($model->file) {
                Storage::delete($model->file);
            }

            $file_extension = $uploaded_file->getClientOriginalExtension();
            // Dynamically name the file with the model ID and extension
            $file_name = $model->id . '.' . $file_extension;
            $file_upload_url = Storage::putFileAs($path, $uploaded_file, $file_name, 'public');

            return Storage::url($file_upload_url);
        }
        return null;
    }
}
