<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Create\CreateParcelDto;
use App\Exception\ValidationException;
use App\Model\Response\ErrorResponse;
use App\Model\Response\ParcelCreateResponse;
use App\Service\DtoDeserializationService;
use App\Service\ParcelService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ParcelAddController extends AbstractController
{
    public function __construct(
        private readonly ParcelService $parcelService,
        private readonly DtoDeserializationService $dtoDeserializationService,
    ) {
    }

    #[Route('/api/v1/parcels', name: 'api_parcel_add', methods: 'POST')]
    #[OA\Tag(name: 'Parcel')]
    #[OA\Response(response: 201, description: 'Parcel created successfully', attachables: [new Model(type: ParcelCreateResponse::class)])]
    #[OA\Response(response: 400, description: 'Validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: CreateParcelDto::class)])]
    public function __invoke(Request $request): JsonResponse
    {
        $dataRequest = $request->getContent();

        $createParcelDto = $this->dtoDeserializationService->deserializeParcelCreateDtoFromJson($dataRequest);

        $parcelResponse = $this->parcelService->createParcel($createParcelDto);

        return $this->json([
            'message' => 'Parcel created successfully',
            'data' => $parcelResponse,
        ], 201);
    }
}
