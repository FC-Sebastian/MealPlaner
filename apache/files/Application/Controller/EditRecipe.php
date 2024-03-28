<?php

namespace Controller;

class EditRecipe extends BaseController
{
    protected $view = 'recipe/edit';
    protected $title = 'Rezept bearbeiten';
    protected $activeHeader = 'recipe';
    protected $activeSubHeader = 'edit';

    public $edit = null;

    public function getIngredients()
    {
        $ingredient = new \Model\Ingredient();
        return $ingredient->loadAll();
    }

    public function save()
    {
        print_r($_FILES);

        $recipe = new \Model\Recipe();
        if ($id = $this->getRequestParameter('id') !== false) {
            $recipe->setId($id);
        }
        $recipe->setTitle($this->getRequestParameter('title'));
        $recipe->setRecipe($this->getRequestParameter('recipe'));
        $recipe->setPortions($this->getRequestParameter('portions'));
        $recipe->setImage($this->handleFileUpload('recipe'));
        $recipe->save();

        $this->edit = $recipe;

        $ingredients = $this->getRequestParameter('ingredient');

        foreach ($ingredients as $ingredient) {
            $recipe2Ingredient = new \Model\Recipe2Ingredient();

            $data = ['recipe_id' => $recipe->getId(), 'ingredient_id' => $ingredient['ingredient'], 'amount' => $ingredient['amount'], 'unit' => $ingredient['unit']];
            if (isset($ingredient['id'])) {
                $data['id'] = $ingredient['id'];
            }
            $recipe2Ingredient->assign($data);
            $recipe2Ingredient->save();
        }
    }

    public function render()
    {
        if ($id = $this->getRequestParameter('id')) {
            $recipe = new \Model\Recipe();
            $recipe->load($id);

            $this->edit = $recipe;
        }
        parent::render();
    }

    protected function handleFileUpload($targetDir)
    {
        if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
            $targetDir = __DIR__."/../../img/$targetDir";
            $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]); // Specify the path of the file

            // Check if the file already exists
            if (file_exists($targetFile)) {
                $targetFile = $targetDir . hash('md5' ,date('Y-m-d H:i:s')) . basename($_FILES["fileToUpload"]["name"]);
            }
            // Attempt to move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                return substr($targetFile, strpos($targetFile, '/', -1));
            } else {
                return "";
            }
        }
    }
}