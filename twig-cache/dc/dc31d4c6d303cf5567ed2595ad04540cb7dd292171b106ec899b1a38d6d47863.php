<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* AdministratorCategoryManagement/getAdd.html */
class __TwigTemplate_9e2a04a88edf01d2edb34db81d99d43b1294da9c04e6bacfd93fca0a7cfe406d extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorCategoryManagement/getAdd.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div>
    <div class=\"options\">
        <a href=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/categories\">Nazad na spisak kategorija</a>
    </div>

    <!--forma za izmenu kategorije-->
    <form class=\"category-form\" method=\"POST\" onsubmit=\"return validateCategoryAddForm();\">
        <div>
            <label for=\"name\">Naziv kategorije:</label>
            <input type=\"text\" id=\"name3\" name=\"name\" required>
        </div>
        <div>
            <button type=\"submit\">
                Dodaj
            </button>
        </div>
        <div class=\"alert alert-warning d-none\" id=\"error-message3\"></div>
    </form>

    <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/formValidation.js\"></script>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorCategoryManagement/getAdd.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 23,  51 => 6,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorCategoryManagement/getAdd.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorCategoryManagement\\getAdd.html");
    }
}
