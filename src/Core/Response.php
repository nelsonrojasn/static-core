<?php
namespace Static\Core;

class Response
{
    public static function json(mixed $data, int $status = 200): string
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public static function text(string $content, int $status = 200): string
    {
        http_response_code($status);
        header('Content-Type: text/plain; charset=utf-8');
        return $content;
    }

    public static function html(string $content, int $status = 200): string
    {
        http_response_code($status);
        header('Content-Type: text/html; charset=utf-8');
        return $content;
    }

    public static function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header("Location: $url");
        exit;
    }

    public static function download(string $filePath, string $filename = null): void
    {
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo "Archivo no encontrado";
            exit;
        }

        $filename = $filename ?: basename($filePath);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filePath));
        
        readfile($filePath);
        exit;
    }
}
