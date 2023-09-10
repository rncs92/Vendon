<?php declare(strict_types=1);

namespace Vendon\Controllers;

use Vendon\Core\Redirect;
use Vendon\Core\TwigView;
use Vendon\Services\Test3\Show\ShowPDOAnswerService;
use Vendon\Services\Test3\Show\ShowPDOQuestionService;
use Vendon\Services\Test3\Store\StorePDOAnswerRequest;
use Vendon\Services\Test3\Store\StorePDOAnswerResponse;
use Vendon\Services\Test3\Store\StorePDOAnswerService;

class TestController
{
    private ShowPDOQuestionService $questionService;
    private StorePDOAnswerService $answerService;


    public function __construct(
        ShowPDOQuestionService $questionService,
        StorePDOAnswerService $answerService
    )
    {
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }

    public function index():TwigView
    {
        return new TwigView('Tests/test1', []);
    }

    public function index2():TwigView
    {
        return new TwigView('Tests/test2', []);
    }

    public function indexTest3():TwigView
    {
        $questions = $this->questionService->handle();

        return new TwigView('Tests/test3', [
           'questions' => $questions,
        ]);
    }

    public function storeAnswersTest3(): Redirect
    {
        $this->answerService->handle(
            new StorePDOAnswerRequest(
                $_POST['question1_answer'],
                $_POST['question2_answer'],
                $_POST['question3_answer'],
                $_POST['question4_answer'],
                $_POST['question5_answer'],
                $_POST['question6_answer'],
                $_POST['question7_answer'],
                $_POST['question8_answer'],
                $_POST['question9_answer'],
                $_POST['question10_answer'],
            )
        );

        return new Redirect('/');
    }
}