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

/* AdministratorCategoryManagement/getEdit.html */
class __TwigTemplate_da1f0c66cb599f451e75fd4c16f877784e3a367035575537f8137a680a09693c extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorCategoryManagement/getEdit.html", 1);
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
        <a href=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/categories/add\">Dodaj novu kategoriju</a>
    </div>

    <!--forma za izmenu kategorije-->
    <form class=\"category-form\" method=\"POST\" onsubmit=\"return validateCategoryEditForm();\">
        <div>
            <label for=\"name\">Naziv kategorije:</label>
            <input type=\"text\" id=\"name4\" name=\"name\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["category"] ?? null), "name", [], "any", false, false, false, 14));
        echo "\">
        </div>
        <div>
            <button type=\"submit\">
                Sačuvaj izmene
            </button>
        </div>
        <div class=\"alert alert-warning d-none\" id=\"error-message4\"></div>
    </form>

    <script src=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "assets/js/formValidation.js\"></script>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorCategoryManagement/getEdit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 24,  65 => 14,  55 => 7,  51 => 6,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorCategoryManagement/getEdit.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorCategoryManagement\\getEdit.html");
    }
}
