<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

trait StringFormatTrait
{
    protected static function mapClearSpecialCharacter($request, array $fields): array
    {
        dd($request,$fields);


        return [];
    }

    protected static function mapDateFormat($request, array $fields): array
    {
        dd($request, $fields);
        return [];
    }
}