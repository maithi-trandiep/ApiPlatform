<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Entity\Recipe;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Recipe && !isset($context[__CLASS__]);
    }

    public function normalize(mixed $object, string $format = null, array $context = []): mixed
    {
        /** @var Recipe $object */

        if (str_contains(strtolower($object->getTitle()), 'wip')) {
            $context['groups'][] = 'recipe:read:is-wip';
        }

        $context[__CLASS__] = true;

        return $this->normalizer->normalize($object, $format, $context);
    }
}
