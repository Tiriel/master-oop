<?php

namespace App\Security\Voter;

use App\Entity\Movie;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieRatingVoter extends Voter
{
    public const RATING = 'movie.rating';

    protected function supports(string $attribute, $subject): bool
    {
        return $attribute === self::RATING && $subject instanceof Movie;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User || !$user->getBirthday()) {
            return false;
        }
        $age = date_diff($user->getBirthday(), new \DateTime())->y;

        /** @var Movie $subject */
        switch ($subject->getRated()) {
            case 'PG':
            case 'PG-13':
                if ($age >= 13) {
                    return true;
                }
                break;
            case 'NC-17':
            case 'R':
                if ($age >= 17) {
                    return true;
                }
                break;
        }

        return false;
    }
}
