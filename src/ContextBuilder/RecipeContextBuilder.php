<?php

declare(strict_types=1);

namespace App\ContextBuilder;

use ApiPlatform\Serializer\SerializerContextBuilderInterface;
use App\Entity\Recipe;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

#[AsDecorator(decorates: 'api_platform.serializer.context_builder')]
class RecipeContextBuilder implements SerializerContextBuilderInterface
{
    public function __construct(
        protected Security $security,
        #[AutowireDecorated] protected SerializerContextBuilderInterface $decorated,
    )
    {
    }

    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);
        $class = $context['resource_class'];
        $userIsConnected = $this->security->getUser() !== null;

        if (!$normalization || $class !== Recipe::class) {
            return $context;
        }

        if ($userIsConnected)   {
            $context['groups'][] = 'recipe:read:user-is-logged';
        }

        return $context;
    }
}
