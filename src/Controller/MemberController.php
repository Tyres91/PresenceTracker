<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    #[Route(path: '/members', name: 'member_list')]
    public function list(MemberRepository $repo)
    {
        $members = $repo->findAll();
        return $this->render('member/index.html.twig', [
        'members' => $members
        ]);
    }
}
