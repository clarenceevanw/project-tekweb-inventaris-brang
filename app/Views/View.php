<?php

class View
{
    protected $sections = [];
    protected $currentSection;
    protected $layout;

    public function extend($layout)
    {
        $this->layout = $layout;
    }

    public function section($name)
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function endSection()
    {
        $this->sections[$this->currentSection] = ob_get_clean();
    }

    public function renderSection($name)
    {
        return $this->sections[$name] ?? '';
    }

    public function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        if (!file_exists($viewPath)) die("View $view not found");

        // Load halaman view terlebih dahulu
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        // Jika ada layout -> load layout
        if ($this->layout) {
            $layoutPath = __DIR__ . '/../../views/' . $this->layout . '.php';
            if (!file_exists($layoutPath)) die("Layout $this->layout not found");
            include $layoutPath;
        } else {
            echo $content;
        }
    }
}
