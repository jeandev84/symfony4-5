<?php

namespace App\Security\Voter;

use App\Entity\Video;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class VideoVoter extends Voter
{
    public const CREATE  = 'VIDEO_CREATE';
    public const EDIT    = 'VIDEO_EDIT';
    public const VIEW    = 'VIDEO_VIEW';
    public const DELETE  = 'VIDEO_DELETE';

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::DELETE, self::VIEW]) && $subject instanceof \App\Entity\Video;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var Video $video */
        $video = $subject;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::DELETE:
                // logic to determine if the user can EDIT
                // return true or false
                // User can delete video if it is owner video !!!
                return $user === $video->getSecurityUser();
                break;
            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                // User can view video if it is owner video !!!
                return $user === $video->getSecurityUser();
                break;
        }

        return false;
    }
}
