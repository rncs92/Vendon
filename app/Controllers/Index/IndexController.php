<?php declare(strict_types=1);

namespace Vendon\Controllers\Index;

use Vendon\Core\Session;
use Vendon\Core\TwigView;
use Vendon\Services\Quiz\Show\ShowPDOQuizService;

class IndexController
{
    private ShowPDOQuizService $quizService;

    public function __construct(
        ShowPDOQuizService $quizService
    )
    {
        $this->quizService = $quizService;
    }

    public function index(): TwigView
    {
        if (!Session::get('user')) {
            return new TwigView('User/login', []);
        }

        $quizzes = $this->quizService->handle();


        return new TwigView('index', [
            'quizzes' => $quizzes
        ]);
    }
}