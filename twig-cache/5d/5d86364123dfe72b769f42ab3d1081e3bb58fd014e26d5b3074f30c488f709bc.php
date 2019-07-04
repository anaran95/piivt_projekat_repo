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

/* AdministratorDashboard/index.html */
class __TwigTemplate_b8bf83c48bc0ce4bae270a1752fd4c39a89b9b01646448b122f9c0e772431450 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("_global/index.html", "AdministratorDashboard/index.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">
    <!--Ovo je dashboard za administratora - ADMIN PROFILE-->
    <div class=\"col text-center\">
    <div class=\"card admin-choice\">
    <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/categories\" class=\"card-text\">Prikaži sve kategorije</a>
    </div>
    </div>
    <div class=\"col text-center\">
    <div class=\"card admin-choice\">
    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/antiques\"  class=\"card-text\">Prikaži sve antikvitete</a>
    </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "AdministratorDashboard/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 13,  53 => 8,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "AdministratorDashboard/index.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\AdministratorDashboard\\index.html");
    }
}
