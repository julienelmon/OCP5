<?php 

namespace OCP5\Service;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRenderer
{
    private $twig;

    public function render($view, $params = [])
    {
        $loader = new Twig_Loader_Filesystem('public/view');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . /tmp,
            'debug' => true,
        ]);
        if (isset($_SESSION['flash'])) {
            $this->twig->addGlobal('session', $_SESSION);
        }

        echo $this->twig->render($view.'.twig', $params);
    }
}

?>