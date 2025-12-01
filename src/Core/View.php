<?php
namespace Static\Core;

class View
{
    private static string $basePath = __DIR__ . '/../../views/';

    public static function render(string $path, array $data = []): void
    {
        $content = self::capture($path, $data);
        echo $content;
    }

    public static function renderWithLayout(
        string $path,
        string $layout,
        array $data = []
    ): void {
        $content = self::capture($path, $data);

        // Pasamos el contenido como variable especial $content
        $data['content'] = $content;

        echo self::capture("layouts/$layout", $data);
    }

    private static function capture(string $path, array $data = []): string
    {
        $fullPath = self::$basePath . $path . '.php';

        if (!file_exists($fullPath)) {
            throw new \RuntimeException("Vista no encontrada: $path");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include $fullPath;
        return ob_get_clean();
    }
}
