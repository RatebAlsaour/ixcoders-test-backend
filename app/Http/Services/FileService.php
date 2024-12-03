<?php

namespace App\Http\Services;


use App\Exceptions\FileStorageException;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FileService implements ShouldQueue
{
    use Queueable;
    public static function storeFiles(UploadedFile $media, string $folderName, string $mediaName = 'default'): array
    {
        try {
            $folderName = str_replace(' ', '-', $folderName);
            $folderName = $folderName . '/' . date('Y-m-d');

            $mediaName1 = pathinfo($media->getClientOriginalName(), PATHINFO_FILENAME);
            $mediaName = str_replace(' ', '-', $mediaName1);
            $mediaName = $mediaName . '-' . Carbon::now()->microsecond;
            $mediaName = Str::slug($mediaName, '-') . '.' . $media->extension();

            $path = $media->storeAs($folderName, $mediaName, 'public');

            // Get media type like (video - image - document ...etc)
            $mime = $media->getClientMimeType();
            $mediaType = explode('/', $mime)[0];

            // Get file size and unit
            [$fileSize, $fileSizeUnit] = self::formatSize($media->getSize());

            if ($path && $mediaType && $fileSize) {
                $fileInfo = [
                    'path' => Storage::url($path),
                    'type' => $mediaType,
                    'name' => $mediaName1,

                    'size' => $fileSize." ".$fileSizeUnit,
                    'unit' => $fileSizeUnit,
                    'extension' => $media->getClientOriginalExtension()
                ];

                return $fileInfo;
            }

            throw new FileStorageException(trans('file.store'), 400);
        } catch (\Exception $e) {
            throw new FileStorageException(trans('file.store'), 400);
        }
    }

    private static function formatSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }

        return [number_format($size, 3), $units[$i]];
    }



//    public static function storeFiles(UploadedFile $media, string $folderName, string $mediaName = 'default'): array
//    {
//        try {
//            $folderName = str_replace(' ', '-', $folderName);
//            $folderName = $folderName . '/' . date('Y-m-d');

//            $mediaName = pathinfo($media->getClientOriginalName(), PATHINFO_FILENAME);
//            $mediaName = str_replace(' ', '-', $mediaName);
//            $mediaName = $mediaName . '-' . Carbon::now()->microsecond;
//            $mediaName = Str::slug($mediaName, '-') . '.' . $media->extension();

//            $path = $media->storeAs($folderName, $mediaName, 'private');

//            // Get media type like (video - image - document ...etc)
//            $mime = $media->getClientMimeType();
//            $mediaType = explode('/', $mime)[0];

//            if ($path && $mediaType) {
//                $fileInfo = [
//                 'path' => url('/private/' . $path),
//                    'type' => $mediaType,
//                ];

//                return $fileInfo;
//            }

//            throw new FileStorageException(trans('file.store'), 400);
//        } catch (\Exception $e) {
//            throw new FileStorageException(trans('file.store'), 400);
//        }
//    }


    public static function storeBase64File(string $base64_file, string $folderName, string $mediaName='default')
    {
        try
        {
            $folderName = str_replace(' ', '-', $folderName);
            $folderName = $folderName . '/' . date('Y-m-d');

            if(!str_contains($base64_file,';'))
                throw new FileStorageException('invalid file format', 400);

            $explodedBase64 = explode(';', $base64_file);
            $type = $explodedBase64[0];
            $file_string = $explodedBase64[count($explodedBase64)-1];

            //explode the type string to get extension from it
            $typeElements = explode('/', $type);

            //extension will be the last item in the array
            $fileExtension = $typeElements[count($typeElements)-1];

            $mediaName = str_replace(' ', '-', $mediaName);
            $mediaName = $mediaName.'-'.Carbon::now()->microsecond . '.' . $fileExtension;

            list(, $fileEncoded) = explode(',', $file_string);
            Storage::disk('public')->put($folderName.'/'.$mediaName, base64_decode($fileEncoded));
            $path = 'storage'.'/'.$folderName.'/'.$mediaName;

            if ($path)
            {
                $fileInfo = [
                    'path' => $path,
                    'type' => 'image',
                ];

                return $fileInfo;
            }

            throw new FileStorageException(trans('file.store'), 400);
        }
        catch (\Exception $e)
        {
            throw new FileStorageException(trans('file.store'), 400);
        }
    }


    static function static(UploadedFile $request)
    {

        $fileName = uniqid().'.'.$request->getClientOriginalExtension();
        $path =  $fileName;

        $request->move(public_path('images'), $fileName);


        return $path;

    }

    public static function storeFiless(UploadedFile $media, string $folderName, string $mediaName = 'default'): array
    {
        try {

            dispatch(new StoreFileJob($media, $folderName, $mediaName));
            return ['message' => 'File upload queued successfully'];
        } catch (\Exception $e) {
            // Handle any exception if needed
            throw new FileStorageException(trans('file.store'), 400);
        }
    }
}
