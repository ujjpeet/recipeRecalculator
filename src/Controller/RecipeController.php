<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Services\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    private RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
     }

    /**
     * @Route("/", name="render_recipe_form")
     */
    public function index(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $title = $data->getTitle();
            $serving = $data->getServing();
            $ingredientName = $data->getIngredientName();
            $ingredientAmount = $data->getIngredientAmount();

            $newRecipe = $this->recipeService->recalculateIngredients($title,$serving, $ingredientName, $ingredientAmount);

            $response = new Response();
            $response->setContent(json_encode([
                $newRecipe
            ]));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

        return $this->renderForm('recipe/index.html.twig', [
            'form' => $form,
        ]);
    }
}
