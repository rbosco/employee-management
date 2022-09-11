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

trait ApiResponser
{
    protected $messages;
    protected function successResponse(array $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status'=> 'Success',
            'statuscode' => $code,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    protected function errorResponse(array $data, int $code, string $message = null): JsonResponse
    {
        return response()->json([
            'status'=>'Error',
            'statuscode' => $code,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    protected function successResponseDatatable(array $data, array $arrOpcoes, int $code = 200): JsonResponse
    {
        return response()->json([
            "draw" => $arrOpcoes['arrKeyCount'],
            "recordsTotal" =>  $arrOpcoes['recordsTotal'],
            "recordsFiltered" => $arrOpcoes['recordsTotal'],
            "data" => $data
        ], $code);
    }

    /**
     * Obs. Esse metodo deve ser usado após o arquivo ser criado se não ser disparado
     * um FileNotFoundException
     */
    protected function downloadResponse(string $file, string $fileName = null, $deleteFileAfterSend = false): BinaryFileResponse
    {
        $headers = [
            'Content-Description: File Transfer',
            'Content-Type: application/octet-stream',
            'Content-Transfer-Encoding: binary',
            'Expires: 0',
            'Content-Length: ' . strlen($file),
            'Cache-Control: must-revalidate',
            'Pragma: public',
            'Content-Disposition: attachment; filename='.$fileName
        ];

        $responseDownload = response()->download($file, $fileName, $headers);
        return !$deleteFileAfterSend ? $responseDownload : $responseDownload->deleteFileAfterSend(true);
    }

    protected function validateForm(array $request, array $rules): bool
    {
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            $this->messages = $validator->messages();
            return false;
        }
        return true;
    }

    protected function errorMessages(): JsonResponse
    {
        $_mensagensErro = [];
        $_chaves = [];

        $contador = 0;

        $_chaves[] = $this->messages->all();
        foreach (array($this->messages->keys())[0] as $valor) {
            $_mensagensErro[$valor] = $_chaves[0][$contador];
            $contador++;
        }

        return $this->errorResponse($_mensagensErro, 422, 'Erro ao processar a operação!');
    }

    protected function uploadFiles(Request $request, string $file, string $folderSaveFiles)
    {
        $upload = null;
        if ($request->hasFile($file) && $request->file($file)->isValid()) {
            $nameFile = $request->file("{$file}")->getClientOriginalName();
            $upload = $request->file("{$file}")->storeAs($folderSaveFiles, $nameFile, ['disk' => 'public']);
            if (!$upload) {
                return throw new UploadException('Erro ao realizar o Upload! Tente novamente!', 500);
            }
        }

        return $upload;
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
