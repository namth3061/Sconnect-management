<?php

namespace App\Traits;
trait ImageTrait
{
    public $files;

    public function setFiles($files): void
    {
        $this->files = $files;
    }

    public function getFileIsImage(): string
    {
        $html = '';
        if ($this->files) {

            if (is_array($this->files)) {
                $html = $this->getMultipleImage();
            } else {
                $html = $this->getImage();
            }

        }

        return $html;
    }

    public function getMultipleImage(): string
    {
        $html = '';
        $countError = 0;

        foreach ($this->files as $file) {
            if (!$this->fileIsImage($file)) {
                $countError++;
            } else {
                $html .= '<img class="rounded w-10 h-10 mt-2 img-thumbnail mx-auto d-block" src="' . $file->temporaryUrl() . '" alt="Uploaded Image">';
            }
        }

        if ($countError > 0) {
            $html .= '<br><span class="text-danger font-weight-bold">' . trans('form.form.image.images_type_error', ['num' => $countError]) . '</span>';
        }

        return $html;
    }

    public function getImage(): string
    {
        if ($this->fileIsImage($this->files)) {
            return '<img class="rounded w-10 h-10 mt-2 img-thumbnail mx-auto d-block" src="' . $this->files->temporaryUrl() . '" alt="Uploaded Image">';
        } else {
            return '<br><span class="text-danger font-weight-bold">' . trans('form.form.image.image_type_error') . '</span>';
        }
    }

    public function fileIsImage($media): bool
    {
        return str_contains($media->getMimeType(), 'image');
    }

    public function getImageFile(): string
    {
        $countError = 0;
        $html = '<ol class="list-group">';

        foreach ($this->files as $key => $value) {
            if (!$this->fileIsImage($value)) {
                $countError++;
            } else {
                $html .= '<li wire:key="" class="list-group-item d-flex justify-content-between align-items-center">
                        <img class="rounded w-10 h-10 mt-2 img-thumbnail" src="' . $value->temporaryUrl() . '" alt="Uploaded Image">
                        <a href="#!">
                            <svg wire:click="removeFileByIndex(' . $key . ')" xmlns="http://www.w3.org/2000/svg" width="16"
                                 height="16" fill="currentColor" class="bi bi-trash2"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793"/>
                            </svg>
                        </a>
                        </li>';
            }
        }

        if ($countError > 0) {
            $html .= '<br><span class="text-danger font-weight-bold">' . trans('form.form.image.images_type_error', ['num' => $countError]) . '</span>';
        }

        $html .= '</ol>';

        return $html;
    }

    public function getNameFile(): string
    {
        $html = '<ol class="list-group">';

        foreach ($this->files as $key => $value) {
            $html .= '<li wire:key="" class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="fw-bold">' . $value->getClientOriginalName() . '</div>
                        <a href="#!">
                        <svg wire:click="removeFileByIndex(' . $key . ')" xmlns="http://www.w3.org/2000/svg" width="16"
                             height="16" fill="currentColor" class="bi bi-trash2"
                             viewBox="0 0 16 16">
                            <path
                                d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793"/>
                        </svg>
                    </a>
                </li>';
        }

        $html .= '</ol>';

        return $html;
    }

}
