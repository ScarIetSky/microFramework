<?php
namespace App\Http\Action\Blog;

use Illuminate\Http\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ShowAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttributes('id');

        if($id > 5) {
            return new JsonResponse(['error' => 'Undefined page'], 404);
        }

        return new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
    }
}