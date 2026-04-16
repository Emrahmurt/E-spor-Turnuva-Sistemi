<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Tüm controller'lar için temel sınıf.
 * View verilerini merkezileştirir ve yardımcı metodlar sunar.
 */
abstract class BaseController extends Controller
{
    protected $helpers = ['url', 'form', 'text', 'html'];
    protected $session;

    // Tüm view'lara otomatik eklenen veriler
    protected $defaultViewData = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();

        // Varsayılan view verileri (örneğin site adı, kullanıcı bilgisi)
        $this->defaultViewData = [
            'siteName' => config('App')->siteName ?? 'Profesyonel Blog',
            'locale'   => $this->request->getLocale(),
            'csrf'     => csrf_token() ?? null,
        ];
    }

    /**
     * View render ederken varsayılan verileri otomatik ekler
     */
    protected function render(string $view, array $data = [], array $options = []): string
    {
        $data = array_merge($this->defaultViewData, $data);
        return view($view, $data, $options);
    }

    /**
     * JSON yanıtı için standart format
     */
   protected function jsonResponse($data, int $statusCode = 200): ResponseInterface
{
    return $this->response
        ->setStatusCode($statusCode)
        ->setJSON($data);
}

   protected function jsonError(string $message, int $statusCode = 400): ResponseInterface
    {
        return $this->jsonResponse([
        'status' => 'error',
        'message' => $message
    ], $statusCode);
    }

    protected function jsonSuccess($data = null, string $message = 'OK'): ResponseInterface
{
    return $this->jsonResponse([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ], 200);
}
}