<?php
    use app\components\SimpleRouter;
    use app\components\ViewRenderer;
    use app\components\Request;
    use app\PalindromeSearch;

    SimpleRouter::addRoute('/api/send', function() {
        $result = PalindromeSearch::getPalindroms(Request::getPost('string'));
        echo $result ? json_encode($result) : json_encode('no data');
    });
    SimpleRouter::addRoute('/', function() {
        ViewRenderer::renderHTML('/dist/palindromeapp.html');
    });
