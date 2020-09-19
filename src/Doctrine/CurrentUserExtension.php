<?php

namespace App\Doctrine;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        ?string $operationName = null
    ) {
        $user = $this->security->getUser();
        if ($resourceClass === Customer::class || $resourceClass == facture::class) {
            $rootAlias = $queryBuilder->getRootAliases()[0];

            if ($resourceClass === Commande::class) {
                $queryBuilder->join("$rootAlias.commande", "c")
                    ->andWhere("c.user = :user");
            }

            $queryBuilder->setParameter("user", $user);
        }
    }

    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        ?string $operationName = null,
        array $context = []
    ) {
    }
}
