<?php
namespace App\Controller;

use App\Entity\Event;
use App\Entity\Member;
use App\Form\EventType;
use App\Form\MemberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'homepage')]
    public function index(Request $request, EntityManagerInterface $em)
    {
        // Event-Form
        $event = new Event();
        $eForm = $this->createForm(EventType::class, $event);
        $eForm->handleRequest($request);
        if ($eForm->isSubmitted() && $eForm->isValid()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        // Member-Form
        $member = new Member();
        $mForm  = $this->createForm(MemberType::class, $member);
        $mForm->handleRequest($request);
        if ($mForm->isSubmitted() && $mForm->isValid()) {
            $em->persist($member);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        // Daten holen
        $events  = $em->getRepository(Event::class)->findBy([], ['date' => 'DESC']);
        $members = $em->getRepository(Member::class)->findAll();

        return $this->render('home/index.html.twig', [
            'eForm'   => $eForm->createView(),
            'mForm'   => $mForm->createView(),
            'events'  => $events,
            'members' => $members,
        ]);
    }
}
