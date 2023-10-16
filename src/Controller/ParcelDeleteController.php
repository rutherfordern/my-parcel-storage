<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\ParcelNotFoundException;
use App\Model\Response\ErrorResponse;
use App\Service\ParcelService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ParcelDeleteController extends AbstractController
{
    public function __construct(
        private readonly ParcelService $parcelService,
    ) {
    }

    #[Route('/api/v1/parcels/{id}', name: 'app_parcel_delete', methods: 'DELETE')]
    #[OA\Tag(name: 'Parcel')]
    #[OA\Response(response: 200, description: 'Parcel deleted successfully')]
    #[OA\Response(response: 404, description: 'Parcel not found')]
    public function __invoke(int $id): JsonResponse
    {
        try {
            $this->parcelService->deleteParcel($id);

            return $this->json([
                'message' => 'Parcel deleted successfully',
            ]);
        } catch (ParcelNotFoundException $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
