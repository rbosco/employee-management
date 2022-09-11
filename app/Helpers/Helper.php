<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use Generator;
use NumberFormatter;
use SplFileInfo;

class Helper
{
    public static function mapInformacoesAtributo(array $array, string $atributo = null): array
    {
        return array_map(function ($item) use ($atributo) {
            return !is_null($atributo) ? $item[$atributo] : $item;
        }, $array);
    }

    public static function mapInformacoesAtributoDuasCamadas(array $array, string $atributo = null): array
    {
        return array_map(function ($item) use ($atributo) {
            return array_map(function ($it) use ($atributo) {
                return !is_null($atributo) ? $it[$atributo] : $it;
            }, $item);
        }, $array);
    }

    public static function mapLambdaInformacoesAtributo(callable $functionArray, array $array, $keys=[])
    {
        return array_map($functionArray, $array, $keys);
    }

    public static function foreachGenerators(array $array): Generator
    {
        foreach ($array as $arr) {
            yield $arr;
        }
    }

    public static function filterInformacoesAtributo(array $array)
    {
        return array_filter($array['array'], function ($item) use ($array) {
            $operador = $array['operacao'];
            $operacao = match (true) {
                $operador === '===' || '==' => $item[$array['atributo']] === $array['valor'],
                $operador === '>==' || '>=' => $item[$array['atributo']] >= $array['valor'],
                $operador === '<==' || '<=' => $item[$array['atributo']] <= $array['valor'],
                $operador === '!==' || '!=' => $item[$array['atributo']] != $array['valor']
            };

            return $operacao;
        });
    }

    public static function mapFilterInformacoesAtributoDuasCamadas(array $array, string $atributo, string $elemento): array
    {
        return array_map(function ($arr) use ($atributo, $elemento) {
            return array_filter($arr, function ($ar) use ($atributo, $elemento) {
                return $ar[$atributo] === $elemento;
            });
        }, $array);
    }

    public static function somatorioValores(array $array): int
    {
        return array_reduce($array, function ($ar, $item) {
            return $ar + $item;
        }, 0);
    }

    public static function somatorioValoresDuasCamadas(array $array): array
    {
        return array_map(function ($arr) {
            return array_reduce($arr, function ($ar, $item) {
                return $ar + $item;
            }, 0);
        }, $array);
    }

    public static function montaGetFiltro(array $filtro): string
    {
        return '?'.http_build_query($filtro, '&');
    }

    public static function diferencasEmMesesDatas(string $dataInicio, string $dataFim): int|string
    {
        $dataInicio = Carbon::parse(is_numeric($dataInicio) ? intval($dataInicio) : strtotime($dataInicio))->format('Y-m-d h:m');
        $datFim = Carbon::parse(is_numeric($dataInicio) ? intval($dataInicio) : strtotime($dataInicio))->format('Y-m-d h:m');
        $diferencaMeses = Carbon::parse($dataInicio)->diffInMonths($datFim);
        return $diferencaMeses;
    }

    public static function unificarEMergearArrays(array $primeiroArray, array $arrays)
    {
        return array_unique(array_merge($primeiroArray, $arrays));
    }

    public static function extrairArrayDeArray(array $array): array
    {
        return array_reduce($array, 'array_merge', []);
    }

    public static function retornarValoresArrayUnico(array $array, bool $unico = true): array
    {
        if ($unico) {
            $array = array_unique($array);
        }
        return array_values($array);
    }

    public static function headersDownloadFiles(string $filename, SplFileInfo|string $file='')
    {
        // Set the header for PHP to tell it, we would like to download a file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Content-Length: ' . strlen($file));
        header('Access-Control-Expose-Headers: Content-Disposition');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Disposition: attachment; filename='.$filename);
    }

    public static function getFileName(string $header)
    {
        if (preg_match('/.*?filename=(?<f>[^\s]+|\x22[^\x22]+\x22)\x3B?.*$/m', $header, $matches)) {
            return rawurldecode($matches[1]);
        }
        throw new Exception(__FUNCTION__ .": Arquivo não Encontrado!!!");
    }

    public static function formataMoeda(int|float $valor, string $locale = "pt_BR", $sufix=false)
    {
        $match = match ($locale) {
            'pt_BR' => 'R$', 'en-US' => '$'
        };
        $valor_format = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return !$sufix ? ltrim(str_replace($match, '', $valor_format->formatCurrency($valor, 'BRL'))) : $valor_format->formatCurrency($valor, 'BRL');
    }

    public static function formataData(string $dataNaoFormatada, string $formatacao = 'd/m/Y'): string
    {
        return  Carbon::parse(is_numeric($dataNaoFormatada) ? intval($dataNaoFormatada) : strtotime($dataNaoFormatada))->format($formatacao);
    }

    public static function validarCPFCNPJ(string $cpfCnpj)
    {
        if (strlen($cpfCnpj) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpfCnpj);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cpfCnpj);
    }
}
