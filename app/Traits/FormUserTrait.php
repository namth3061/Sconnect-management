<?php

namespace App\Traits;

use Livewire\Attributes\On;

trait FormUserTrait
{
    public function getRules(): array
    {
        $flattenedRules = [];

        $forms = array_merge(
            $this->formUploadFile(true), $this->formAddUser(true),
            $this->formInformation(true), $this->formSecurity(true)
        );

        foreach ($forms as $subArray) {
            $flattenedRules = array_merge($flattenedRules, $subArray);
        }

        return $flattenedRules;
    }

    public function formUploadFile($setRule = false): array
    {
        return $this->formUser->uploadFile($setRule, $this->user);
    }

    public function formAddUser($setRule = false): array
    {
        return $this->formUser->addUser($setRule, $this->user);
    }

    public function formInformation($setRule = false): array
    {
        return $this->formUser->information($setRule, $this->user);
    }

    public function formSecurity($setRule = false): array
    {
        return $this->formUser->security($setRule, $this->user);
    }

    public function showPreviewMultipleFile($typeFile): string
    {
        $this->resetPropAndFiles('htmlShowPreviewFile', $this->user_image);
        return $typeFile === 'file' ? $this->getNameFile() : $this->getImageFile();
    }

    public function showPreviewImageFile(): string
    {
        $this->resetPropAndFiles('htmlShowPreviewFile', $this->user_image);
        return $this->getFileIsImage();
    }

    public function removeFileByIndex($index): void
    {
        unset($this->user_image[$index]);
    }

    public function resetPropAndFiles(string $prop, $file): void
    {
        $this->reset($prop);
        $this->setFiles($file);
    }

    #[On('tenant_id')]
    public function getTenantId($data): void
    {
       $this->tenant_id = (int)$data; 
    }

    #[On('user_type')]
    public function getUserType($data): void
    {
       $this->user_type = $data; 
    }

    #[On('status')]
    public function getStatus($data): void
    {
       $this->status = $data; 
    }

}
