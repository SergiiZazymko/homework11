<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 19.02.18
 * Time: 9:10
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeworkController extends Controller
{
    private const MENU = [
        'Home',
        [
            'Contact',
            'Write us',
            'Contact page',
            'Something else',
        ],
        'About',
        'Projects',
        [
            'Products',
            'TV',
            'Radio',
            'MP3',
            'Phone',
            'Games',
        ],
        'Company ',
    ];

    public function welcome()
    {
        return $this->render('homework/welcome.html.twig');
    }

    public function showTemplate($name)
    {
        return $this->render('homework/hello.html.twig', ['name' => ucwords($name)]);
    }

    /**
     * @Route(
     *     "/age/{number}",
     *     name="age_array",
     *     defaults={"number" : 33},
     *     requirements={"number" : "\d+"}
     *     )
     */
    public function ageArray($number)
    {
        return new JsonResponse(['age' => $number]);
    }

    /**
     * @Route(
     *     "/user/{name}",
     *     name="user_name",
     *     defaults={"name" : "username"}
     *     )
     */
    public function userName($name, SessionInterface $session)
    {
        $session->set('username', $name);
        return $this->forward('App\Controller\HomeworkController::forwardMethod');
    }

    /**
     * @Route(
     *     "/get_session",
     *     name="get_session"
     * )
     */
    public function forwardMethod(SessionInterface $session)
    {
        $username = $session->get('username') ?? 'undefined';
        return $this->render('homework/session.html.twig', ['sessionData' => $username]);
    }

    public function googleSearch($query)
    {
        return $this->redirect("https://www.google.com/search?q=$query");
    }

    public function yahooSearch($query)
    {
        return $this->redirect("https://search.yahoo.com/search?p=$query");
    }

    /**
     * @Route(
     *     "/post/page/{number}",
     *     name="page_number",
     *     defaults={"number" : 1},
     *     methods={"GET"},
     *     requirements={"number" : "^[1-9]|[1-9]\d$"}
     *     )
     */
    public function pageNumber($number)
    {
        //$this->drawMenu();
        return $this->render('homework/page.html.twig', ['number' => $number]);
    }

    /**
     * @Route(
     *     "/menu",
     *     name="menu"
     * )
     */
    public function drawMenu()
    {
        return $this->render('menu/menu.html.twig', ['menu' => self::MENU]);
    }
}
