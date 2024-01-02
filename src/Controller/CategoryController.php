<?php

namespace App\Controller;

use App\Entity\Category;
use App\helpers;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\CategoryRepository;
use App\Validator\Validator;
use Twig\Environment;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;

    private Hydrator $hydrator;

    private helpers $helpers;

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        $this->categoryRepository = new CategoryRepository();
        $this->hydrator = new Hydrator();
        $this->helpers = new helpers();
        parent::__construct($twig, $request, $session, $files);
    }

    public function newCategory()
    {
        if (! empty($this->request->getParams('POST'))) {
            $categ = new Category();

            $validator = new Validator();
            $errors = $validator->validate($categ, $this->request->getParams('POST'));

            if (! empty($errors)) {
                return $this->render('admin/newCategory.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST')]);
            }

            $this->hydrator->hydrate($categ, $this->request->getParams('POST'));

            $categ->setCategorySlug($this->helpers->slugify($categ->getName()));

            if (! $this->categoryRepository->newCategory($categ)) {
                return $this->render('admin/newCategory.html.twig', ['message' => 'Une erreur est survenue lors de l\'ajout de la catégorie', 'post' => $this->request->getParams('POST')]);
            }

            $this->redirect('/admin');
        }

        return $this->render('admin/newCategory.html.twig');
    }

    /*
    * @param int $id
    */
    public function editCategory(int $id)
    {
        if (! empty($this->request->getParams('POST'))) {
            $categ = new Category();

            $validator = new Validator();
            $errors = $validator->validate($categ, $this->request->getParams('POST'));

            if (! empty($errors)) {
                return $this->render('admin/editCategory.html.twig', ['errors' => $errors, 'post' => $this->request->getParams('POST')]);
            }

            $this->hydrator->hydrate($categ, $this->request->getParams('POST'));

            $categ->setCategorySlug($this->helpers->slugify($categ->getName()));
            $categ->setCategoryId($id);

            if (! $this->categoryRepository->editCategory($categ)) {
                return $this->render('admin/editCategory.html.twig', ['message' => 'Une erreur est survenue lors de la modification de la catégorie', 'post' => $this->request->getParams('POST')]);
            }

            $this->redirect('/admin');
        }

        $categ = $this->categoryRepository->getCategoryById($id);

        return $this->render('admin/editCategory.html.twig', ['category' => $categ, 'type' => 'edit']);
    }

    /*
    * @param int $id
    */
    public function deleteCategory(int $id)
    {
        if (! $this->categoryRepository->deleteCategory($id)) {
            return $this->render('admin/editCategory.html.twig', ['message' => 'Un article possède la catégorie que vous souhaitez supprimer', 'category' => $this->categoryRepository->getCategoryById($id), 'type' => 'edit']);
        }

        $this->redirect('/admin');
    }
}
