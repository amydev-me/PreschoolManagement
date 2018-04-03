<?php


namespace Data\FileSystem;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFileSystem {
    protected $allowedMimeTypes = [];
    protected $path;
    private $file;
    private $storedName;
    public $defaultimg='img/default.png';
    public function __construct($file) {
        $this->path = '';
        $this->storedName = '';
        if ($file instanceof UploadedFile) {
            $this->file = $file;
        }

        if (is_string($file)) {
           $this->storedName = $file;
        }
    }

    public function getPath()  {
        return $this->path;
    }

    public function getStoredName()  {
        return $this->storedName;
    }

    public function getStoragePath(){
        return storage_path() . '/app/' .$this->path . '/' . $this->storedName;
    }

    public function getClientOriginalName()  {
        if ($this->file instanceof UploadedFile) {
            return $this->file->getClientOriginalName();
        }

        return '';
    }

    public function getClientOriginalExtension()  {
        if ($this->file instanceof UploadedFile) {
            return $this->file->getClientOriginalExtension();
        }

        return '';
    }

    public function getClientSize()  {
        if ($this->file instanceof UploadedFile) {
            return $this->file->getClientSize();
        }

        return null;
    }

    public function store()  {
        if (!($this->file instanceof UploadedFile)) return false;

        if (!$this->checkMimeType($this->file->getMimeType())) return false;

        $result = false;
        try {
            $fileName=Storage::put($this->getPath(), $this->file);
//            $fileName = $this->file->store(storage_path() . '/app/public/images/business');
//            Storage::disks('public/images/business')->put($this->file->getClientOriginalName(),File::get($this->file));

            if ($fileName) {
                $this->storedName = basename($fileName);
                $result = true;
            }
        } catch(\ErrorException $e) { }

        return $result;
    }


    public function delete()  {
//        if($this->exists()){
        return Storage::delete($this->getPath().'/'. $this->storedName);
//            return  unlink(storage_path() . '/app/public/' .$this->path . '/' . $this->storedName);
//        }
//        return false;
    }

    public function exists()  {
        return $this->path . '/' . $this->storedName;
    }

    public function checkfile(){
        return file_exists(storage_path().'/app/'.$this->getPath().'/'.$this->storedName);
    }

    public function getFileResponse() {

        return response()->file(storage_path() .'/app/'.$this->getPath() . '/' . $this->storedName);
    }

    private function checkMimeType($mimeType)  {
        if (count($this->allowedMimeTypes) > 0)
            return in_array($mimeType, $this->allowedMimeTypes);
        else
            return true;
    }

    public function getFileSize(){
        if($this->exists()){return $this->bytesToHuman(Storage::size($this->path . '/' . $this->storedName));}

        return 0;
    }

    public function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}