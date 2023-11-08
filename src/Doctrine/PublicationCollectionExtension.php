<?php

declare(strict_types=1);

namespace App\Doctrine;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

class PublicationCollectionExtension implements QueryCollectionExtensionInterface
{
    public function __construct(
        protected Security $security
    )
    {
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $isGoodOperation = $operation instanceof GetCollection && $operation->getName() === 'coucou';

        if (!$isGoodOperation) {
            return;
        }

//        $alias = $queryBuilder->getRootAliases()[0];
//        $queryBuilder
//            ->andWhere("$alias.author = 1 AND $alias.title LIKE '%Quod%'");
    }
}
