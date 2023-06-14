<?php

namespace App\Http\Controllers\Media\Contract;

interface MediaInterface
{
    public function store($path, $extension, $mimeType, $size, $pathInfo): mixed;

    public function media(): mixed;

    public function mediaById($mediaId): mixed;

    public function destroy($mediaId): ?bool;
}
