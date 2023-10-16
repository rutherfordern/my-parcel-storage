<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Create\CreateParcelDto;
use App\Entity\Parcel;
use App\Factory\Search\SearchStrategyFactory;
use App\Service\ParcelService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParcelSearchController extends AbstractController
{
    public function __construct(
        private SearchStrategyFactory $strategyFactory,
    ) {
    }

    #[OA\Response(
        response: 200,
        description: 'Return parcels',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Parcel::class, groups: ['full']))
        )
    )]
    #[OA\Parameter(
        name: 'searchType',
        description: 'Поле используется для определения типа поиска. Допустимые значения sender_phone и receiver_fullname',
        in: 'query',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'q',
        description: 'Поле используется для поиска по заданному значению',
        in: 'query',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'Parcel')]
    #[Route('/api/v1/parcels', name: 'app_parcel_search', methods: 'GET')]
    public function __invoke(Request $request): JsonResponse
    {
        $searchType = $request->query->get('searchType');
        $query = $request->query->get('q');

        try {
            $strategy = $this->strategyFactory->createStrategy($searchType);
            $parcels = $strategy->search($query);

            return $this->json([
                'data' => $parcels,
            ]);
        } catch (\InvalidArgumentException $e) {
            return $this->json(['message' => 'Invalid searchType'], 400);
        }
    }
}
