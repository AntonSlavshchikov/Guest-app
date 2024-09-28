<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class ApiController
{
    private bool $isStatistic = false;
    private int $memory;
    private float $startTime = 0;

    protected function collectingStatistic(): void
    {
        $this->isStatistic = true;
        $this->startTime = microtime(true);
    }

    private function getResultStatistics(): array
    {
        $this->isStatistic = true;
        $this->memory = memory_get_usage();

        return [
            'time' => round(microtime(true) - $this->startTime, 2),
            'memory' => round($this->memory / 1024, 2),
        ];
    }

    protected function response(mixed $data, ?int $status = Response::HTTP_OK): JsonResponse
    {
        if ($this->isStatistic) {
            $statistic = $this->getResultStatistics();
            return response()->json(
                [
                    'data' => $data,
                ],
                $status,
                [
                    'X-Debug-Time' => $statistic['time'],
                    'X-Debug-Memory' => $statistic['memory'],
                ]);
        }

        return response()->json([
            'data' => $data,
        ], $status
        );

    }

    protected function responseError(string $message, ?int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        if ($this->isStatistic) {
            $statistic = $this->getResultStatistics();
            return response()
                ->json(
                    [
                        'error' => [
                            'message' => $message,
                        ]
                    ],
                    $code,
                    [
                        'X-Debug-Time' => $statistic['time'],
                        'X-Debug-Memory' => $statistic['memory'],
                    ]
                );
        }

        return response()
            ->json([
                'error' => [
                    'message' => $message,
                ]
            ], $code);
    }
}
