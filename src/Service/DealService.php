<?php

namespace App\Service;

use App\Repository\Deal\DealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DealService extends AbstractController
{
    private DealRepository $repository;

    public function __construct(DealRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildResult($query, $sort)
    {
        return $this->repository->search($query, $sort);
    }
}    